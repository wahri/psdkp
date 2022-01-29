@extends('layouts.app')

@section('title',"PSDKP | USERS")

@section('content')
     <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">

    <form method="POST" id="addFormatDocumentForm" action="">
        @csrf
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col">
                        <div class="card card-success">
                            <div class="card-header">
                            {{-- <h3 class="card-title"></h3> --}}
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="mr-3" for="document_name">Nama Dokumen :</label>
                                            <input type="text" id="document_name" name="document_name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-11" id="columnContainer">
                       
                    </div>
                    <div class="col-1 sticky">
                        <div class="card card-success">
                            <div class="card-header">
                            {{-- <h3 class="card-title"></h3> --}}
                            </div>
                            <div class="card-body">
                                <div class="row px-2">
                                  <button class="btn text-primary" id="addColumnButton" type="button">
                                      <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        <button type="submit" class="btn btn-success float btn-lg">
           Simpan
        </button>
    </form>

</div>
<!-- /.content-wrapper -->
@endsection

{{-- THIS SCRIPT ONLY RENDER FOR THIS PAGE --}}
@push('script')
   <script>
       $(function(){
           let addColumnButton = $("button#addColumnButton");
           let columnContainer = $("div#columnContainer");
           let addFormatDocumentForm = $("form#addFormatDocumentForm");

           addNewColumn();

           function addNewColumn(){
               let index = columnContainer.find("div[name='column']").length;

               let html = `
                    <div class="card card-success" name="column" data-index="${index}" id="column-${index}">
                        <div class="card-header">
                            {{-- <h3 class="card-title"></h3> --}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama :</label>
                                        <input type="text" name="input[${index}][name]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tipe :</label>
                                        <select name="input[${index}][type]" class="custom-select">
                                            <option value="">Pilih Tipe</option>
                                            <option value="text">Text</option>
                                            <option value="date">Tanggal</option>
                                            <option value="option">Pilihan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12" hidden name="option-col" id="option-col-${index}">
                                    <div class="form-group">
                                        <label>Pilihan :</label>
                                        <div class="row" name="option">
                                        </div>
                                        <button name="option-add" class="btn text-primary" type="button"> <i class="fas fa-plus"></i> Tambahkan Pilihan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button class="btn text-danger" name="delete-column" id="delete-column-${index}" type="button">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
               `;
               columnContainer.append(html);
               
           }


            $(columnContainer).on("change","select[name*='type']",function(){
                let column = $(this).closest(`div[name='column']`);
                let index = column.attr('data-index');
                
                let typeInput = $(this).val();
                if(typeInput == 'option'){
                    addNewSelectOption(index);
                    column.find(`div[name*='option-col']`).removeAttr('hidden');
                }else{
                    column.find(`div[name*='option-col']`).attr('hidden',true);
                    column.find(`div[name*='option-col'] div[name='option']`).empty();
                }
            });

            $(columnContainer).on("click","button[name*='delete-column']",function(){
                $(this).closest(`div[name='column']`).remove().promise().done(function(){
                    renumberingInputIndex();
                });
            });

            $(columnContainer).on("click","button[name='option-add']",function(){
                let column = $(this).closest(`div[name='column']`);
                let index = column.attr('data-index');
                addNewSelectOption(index); 
            })
        

            addColumnButton.on("click",function(){
                addNewColumn();
            })


            function addNewSelectOption(inputIndex){
                let column = $(`div#column-${inputIndex}`);
                let option = column.find("div[name='option']");
                let index = option.find("div").length;

                let html = `
                    <div class="col-3 d-flex mb-3" name="option-col">
                        <input type="text" id="category_name" placeholder="Pilihan ${index+1}" name="input[${inputIndex}][option][${index}]" class="form-control border-0">
                        <button class="btn text-primary ml-2" name="option-delete" type="button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `
                option.append(html);
            }               

            $(columnContainer).on("click","button[name='option-delete']",function(){
                $(this).closest(`div[name='option-col']`).remove().promise().done(function(){
                    renumberingInputIndex();
                });
            });

            
           function renumberingInputIndex(){
                $.each(columnContainer.children(),function (index,row){
                    $(row).attr('id', `column-${index}`);
                    $(row).attr('data-index', `${index}`);
                    $(row).find("input[name*='name']").attr('name', `input[${index}][name]`);
                    $(row).find("select[name*='type']").attr('name', `input[${index}][type]`);
                    $(row).find("div[name*='option-col']").attr('id', `option-col-${index}`);
                    $(row).find("button[name*='delete-column']").attr('id', `delete-column-${index}`);

                  $.each($(row).find("div[name*='option-col'] div[name='option']").children(),function(indexOption,row){
                    $(row).find("input[name*='option']").attr('name', `input[${index}][option][${indexOption}]`);
                    $(row).find("input[name*='option']").attr('placeholder', `Pilihan ${indexOption + 1}`);
                  })
                });
            }

            addFormatDocumentForm.on("submit",function(event){
                event.preventDefault();

                let data = $(this).serialize();
                

                $.ajax({
                    url:"{{ route('dashboard.document-format.store') }}",
                    method:"POST",
                    data:data,
                    dataType:"JSON",
                    success:function(res){
                        showNotification("Masuk","success",3000);
                    },
                    error:function(res){

                    }
                    
                })
            })


       });
   </script>
@endpush


{{-- THIS STYLE ONLY RENDER FOR THIS PAGE --}}
@push('style')
<style>

.float{
	position:fixed;
	bottom:40px;
	right:40px;
	color:#FFF;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}

.my-float{
	margin-top:22px;
}
</style>
@endpush


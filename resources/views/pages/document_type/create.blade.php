@extends('layouts.app')

@section('title',"PSDKP | Jenis Dokumen")

@section('content')
<!-- Content Wrapper. Contains page content -->
<form method="POST" id="addFormatDocumentForm" action="">
    @csrf
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 justify-content-between">
                    <div class="col-sm-6">
                        <h1 class="m-0">Jenis Dokumen</h1>
                    </div><!-- /.col -->
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

    
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="card card-success">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="mr-3" for="name">Nama Dokumen :</label>
                                                <input type="text" id="name" name="name" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="mr-3" for="information">Keterangan :</label>
                                                <textarea name="information" class="wysiwyg"></textarea>
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
                        <div class="col-1 d-flex justify-content-center align-items-start">
                            <button class="btn btn-primary" id="addColumnButton" type="button">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
    </div>
</form>

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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label>Nama :</label>
                                        <input type="text" name="input_format[${index}][name]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label>Keterangan isi :</label>
                                        <input type="text" name="input_format[${index}][description]" class="form-control">
                                    </div>
                                </div>  
                                <div class="col-2 d-flex align-items-center justify-content-end">       
                                    <button class="btn text-danger" name="delete-column" id="delete-column-${index}" type="button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
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
                let column = $(this).closest(`div[name='column']`);

                if(column.attr('data-index') != 0){
                    column.remove().promise().done(function(){
                        renumberingInputIndex();
                    });
                }
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
                        <input type="text" id="category_name" placeholder="Pilihan ${index+1}" name="input_format[${inputIndex}][option][${index}]" class="form-control border-0">
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
                    // console.log(index)
                    $(row).find("input[name*='name']").attr('name', `input_format[${index}][name]`);
                    $(row).find("input[name*='description']").attr('name', `input_format[${index}][description]`);
                    $(row).find("button[name*='delete-column']").attr('id', `delete-column-${index}`);
                    // $(row).find("select[name*='type']").attr('name', `input_format[${index}][type]`);
                    // $(row).find("div[name*='option-col']").attr('id', `option-col-${index}`);

                //   $.each($(row).find("div[name*='option-col'] div[name='option']").children(),function(indexOption,rowOption){
                //       console.log(rowOption);
                //     $(rowOption).find("input[name*='option']").attr('name', `input_format[${index}][option][${indexOption}]`);
                //     $(rowOption).find("input[name*='option']").attr('placeholder', `Pilihan ${indexOption + 1}`);
                //   })
                });
            }

            addFormatDocumentForm.on("submit",function(event){
                event.preventDefault();

                let data = $(this).serialize();
                

                $.ajax({
                    url:"{{ route('dashboard.document-type.store') }}",
                    method:"POST",
                    data:data,
                    dataType:"JSON",
                    success:function(res){
                        showNotification(res.message, "success", 3000);
                        window.location.href = "{{ route('dashboard.document-type.index') }}";
                    },
                    error:function(res){
                        let data = res.responseJSON;
                        showNotification(data.message, "error", 3000);
                    }
                    
                })
            })


       });
   </script>
@endpush


{{-- THIS STYLE ONLY RENDER FOR THIS PAGE --}}
@push('style')
<style>

</style>
@endpush


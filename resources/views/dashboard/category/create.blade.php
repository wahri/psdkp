@extends('dashboard.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" placeholder="Category Name" autofocus>
                                </div>
                                <div id="fieldInput">
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="text" class="form-control" placeholder="Field Name">
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option hidden>Select Type</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary" id="add"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <script>
        $(document).ready(function() {
            $("#add").click(function() {
                var lastField = $("#buildyourform div:last");
                var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
                var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
                fieldWrapper.data("idx", intId);
                var fName = $("<input type=\"text\" class=\"fieldname\" />");
                var fType = $(
                    "<select class=\"fieldtype\"><option value=\"checkbox\">Checked</option><option value=\"textbox\">Text</option><option value=\"textarea\">Paragraph</option></select>"
                );
                var removeButton = $("<input type=\"button\" class=\"remove\" value=\"-\" />");

                var input = `<div class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="Field Name">
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option hidden>Select Type</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>`
                removeButton.click(function() {
                    $(this).parent().remove();
                });
                fieldWrapper.append(fName);
                fieldWrapper.append(fType);
                fieldWrapper.append(removeButton);
                $("#fieldInput").append(input);
            });
            $("#preview").click(function() {
                $("#yourform").remove();
                var fieldSet = $("<fieldset id=\"yourform\"><legend>Your Form</legend></fieldset>");
                $("#buildyourform div").each(function() {
                    var id = "input" + $(this).attr("id").replace("field", "");
                    var label = $("<label for=\"" + id + "\">" + $(this).find("input.fieldname")
                        .first().val() + "</label>");
                    var input;
                    switch ($(this).find("select.fieldtype").first().val()) {
                        case "checkbox":
                            input = $("<input type=\"checkbox\" id=\"" + id + "\" name=\"" + id +
                                "\" />");
                            break;
                        case "textbox":
                            input = $("<input type=\"text\" id=\"" + id + "\" name=\"" + id +
                                "\" />");
                            break;
                        case "textarea":
                            input = $("<textarea id=\"" + id + "\" name=\"" + id +
                                "\" ></textarea>");
                            break;
                    }
                    fieldSet.append(label);
                    fieldSet.append(input);
                });
                $("body").append(fieldSet);
            });
        });
    </script>
@endsection

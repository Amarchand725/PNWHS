{!! Form::open([
'route' => 'uploadfiles',
'id' => 'form4',
'files' => 'true',
'name'  => 'form4',
]) !!}

<style>
	#autoResizeTA{
		height: 39px !important;
	}
	#autoResizeTb{
		height: 200px !important;
	}
</style>

    <h2>List of Document Required</h2>
    <table class="table table-striped" id="item_table">
        <tbody id='transaction_tbody3'>
            <tr>
                <th>CNIC attested copy of front</th>
                <th>CNIC attested copy of back</th>
            </tr>
            <tr>
                <td>
                    <input type="file" name="cnicfront" class="form-control">
                </td>
                <td>
                    <input type="file" name="cnicback" class="form-control" >
                </td>
            </tr>
            <tr>
                <th>Children B form attested copy</th>
                <th>F(PA)-7 form copy</th>
            </tr>
            <tr>
                <td>
                    <input type="file" name="childrenbform" class="form-control" multiple="multiple">
                </td>
                <td>
                    <input type="file" name="fpaform" class="form-control" multiple="multiple">
                </td>
            </tr>
            <tr>
                <th>Applicants color photograph</th>
            </tr>
            <tr>
                <td>
                    <input type="file" name="applicant_photograph" class="form-control" multiple="multiple">
                </td>
            </tr>
            <tr>
                <th>NOK (Next of Kin) CNIC front</th>
                <th>NOK (Next of Kin) CNIC back</th>
                <th class="text text-center">Actions</th>
            </tr>
            <tr class='transaction_row2'>
                <td>
                    <input type="file"  name="transactionform2[0][nextofkinfilefront]" class="form-control" id='nextofkinfilefront' multiple="multiple">
                </td>
                <td>
                    <input type="file"  name="transactionform2[0][nextofkinfileback]" class="form-control" id='nextofkinfileback'  multiple="multiple">
                </td>
                <td class="text-center">
                    <button type='button' class='btn btn-success addMore3'><i class="fa fa-plus"></i></button>
                    <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>
        </tbody>
    </table>

	<div class='row'>
        <div class="col-md-12">
            <div class="form-group">
                <ul class="pager wizard">
                    <li class=" pull-right">
                        <input type='submit' name='next' class=" btn btn-info" value='Finish'/>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        jQuery('#autoResizeTA').autogrow();
        var counter =0;
        $("body").on('click','.addMore3',function(){
            counter++;
            var new_tr  = $(this).closest(".transaction_row2").clone();

            //getting name attributes
            var nextofkinfilefront = "transactionform2["+counter+"][nextofkinfilefront]";
            var nextofkinfileback = "transactionform2["+counter+"][nextofkinfileback]";

            //setting name attributes
            new_tr.find('#nextofkinfilefront').attr('name',nextofkinfilefront).val('');
            new_tr.find('#nextofkinfileback').attr('name',nextofkinfileback).val('');

            $("#transaction_tbody3").append(new_tr);
        });
        $("body").on('click','.delete,.delete_tax',function(){
            $(this).closest('tr').remove();
        });
    </script>
    <script>
        $(function() {
            $("form[name='form4']").validate({
                rules: {
                    cnicfront: {
                            required: true,
                        },
                        cnicback: {
                            required: true,
                        },

                        childrenbform: {
                            required: true,
                        },
                        fpaform: {
                            required: true,
                        },
                        applicant_photograph: {
                            required: true,
                        },
                },

                // Specify validation error messages
                messages: {
                    cnicfront: "Please Upload CNIC Front",
                    cnicback: "Please Upload CNIC Front",
                    childrenbform: "Please Upload Children B form",
                    fpaform: "Please Upload fpaform Form ",
                    applicant_photograph: "Please Upload Applicant Photograph",

                },
                errorPlacement: function(error, element)
                {
                    if ( element.is(":radio") )
                    {
                        error.appendTo( element.parents('.form-group') );
                    }
                    else
                    { // This is the default behavior
                        error.insertAfter( element );
                    }
                },

                submitHandler: function(form) {
                $(".basic-wizard").attr("id","progressWizard");
                form.submit();
                    $(".basic-wizard").removeAttr("id");
                }
            });
        });
    </script>
{!! Form::close() !!}


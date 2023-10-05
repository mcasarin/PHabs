//função Busca cartão live
function fill(Value) {
    $('#busca').val(Value);
    $('#resultadobusca').hide();
  }
  $(document).ready(function() {
    $("#busca").keyup(function() {
        var name = $('#busca').val();
        //Validating, if "name" is empty.
        if (name == "") {
            $("#resultadobusca").html("");
        }
        //If name is not empty.
        else {
            //AJAX is called.
            $.ajax({
                //AJAX type is "Post".
                type: "POST",
                //Data will be sent to "ajax.php".
                url: "include/ajax-baixa.php",
                //Data, that will be sent to "ajax.php".
                data: {
                    search: name
                },
                //If result found, this funtion will be called.
                success: function(html) {
                    //Assigning result to "resultadobusca" div in "search.php" file.
                    $("#resultadobusca").html(html).show();
                }
            });
        }
    });
});
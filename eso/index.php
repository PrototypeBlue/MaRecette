<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Input Dinamico</title>

    <head>
        <title>Agregar o eliminar dinámicamente los campos en PHP con JQuery</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
</head>
<body>
<div class="container">
    <br />
    <br />
    <h2 >Agregar o eliminar dinámicamente los campos en PHP con JQuery</h2><br><br>
    <div class="row col-md-10">
        <div class="form-group">
            <form name="add_name" id="add_name">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <td> <select style="width:80%; max-width:600px" name="name[]" id="name">
                                            
                                            <?php    
                                            include ("db_conection.php");
                                              //  $sql = "SELECT * FROM marcas";
                                                $sql =  "SELECT *  FROM items";
                                              $result = $dbcon->query($sql);

                                              
                                                
                                                while ($valores = mysqli_fetch_array($result)) {
                                                    echo '<option value="'.$valores[item_id].'">'.$valores[item_name].'</option>';
                                                }
                                            ?>

<td> <input type="number" id="cant" name="cant[]" placeholder = "Ingresar cantidad" > </td>
                                            
                                    
                                    </select></td>
                            <td><button type="button" name="add" id="add" class="btn btn-primary">Add </button></td>
                        </tr>
                    </table>
                    <input type="button" name="submit" id="submit" class="btn btn-success" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

    $(document).ready(function(){
        var i = 1;
        
         
        $('#add').click(function () {
            var  valor1 = document.getElementById("name").value;
        var combo = document.getElementById("name");
         var selected = combo.options[combo.selectedIndex].text;
         var  cant = document.getElementById("cant").value;
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'">' +
                                        '<td><select style="width:80%; max-width:600px" name="name[]" id="name">' + '<option value="'+valor1+'">'+selected+'</option>' +
                                            
                                            <?php    
                                         
                                             
                                               
                                                
                                            ?>
                
                                            
                                            
                                    
                                    '</select></td>' +
                                    '<td> <input type="number" id="cant[]" name="cant[]" placeholder = "Ingresar cantidad" value='+cant+' > </td>' +
                                        '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                                        '</tr>');
        });
        
        $(document).on('click', '.btn_remove', function () {
            var id = $(this).attr('id');
           $('#row'+ id).remove();
        });

        $('#submit').click(function(){
            $.ajax({
                url:"name.php",
                method:"POST",
                data:$('#add_name').serialize(),
                success:function(data)
                {
                    alert(data);
                    $('#add_name')[0].reset();
                }
            });
        });
    })
</script>


</body>
</html>
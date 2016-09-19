<!--
Web Programming Term Project
Team name: Web Apes
Team members: Ashley Baik, John Chiao, Yongquan Tan, Yuchen Yuan
This is index.php, the front page of the recipe site.
-->

<!DOCTYPE html>
<html>
    <head>
        <title>Midnight Munchies</title>
        <meta charset = "utf-8" />
        <link href = "css/bootstrap.min.css" type = "text/css" rel = "stylesheet" />
        <link href = "css/food.css" type = "text/css" rel = "stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Raleway:200italic,300' rel='stylesheet' type='text/css'>
    </head>

    <body class="container">
        <div class="background-image  text-center"></div>
        <br>
        <div class="content text-center recipe" id="space">
        <div id = "head">
            <h1>
                Midnight Munchies!
            </h1>
            <p>
                What time is it? 12am? Well.. we know that assignment due tomorrow
                isn't going to happen soon. Instead, you should listen to your growling 
                stomach and cook yourself that grilled chicken sandwich you wanted for 
                dinner, or bake yourself those caramel-filled brownies. Dinner was a 
                good six hours ago, so you have an excuse for eating past midnight.
            </p>
        </div>

        <form action="search.php" method="get" id="form">
            <div>
                <h3>What do you feel like eating?</h3>
                <div class="radio">
                    <label><input type="radio" name="type" value="sweet">Sweet things</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="type" value="savory">Savory things</label>
                </div>

                <h3>Look in your fridge. What ingredients do you have?</h3>
                <div id="pet">
                    <input type="text" name="ingredients[]" id="in1" class="form-control" style="width: 300px; margin: auto;">
                    <br>
                </div>
                <div>
                    <input type="button" id="addnew" class="btn btn-primary" value="Add another ingredient">
                    <script type="text/javascript">
                        //function to add text boxes when "add new ingredient" button is clicked
                        var count = 1;
                        function createField() {
                            count++;
                            var input = document.createElement('input');
                            input.type = 'text';
                            input.name = 'ingredients[]';
                            input.id = 'in' + count;
                            input.className = 'form-control';
                            input.style ='width: 300px; margin: auto;';
                            return input;
                        }

                        var form = document.getElementById('pet');
                        var br = document.createElement("br");
                        document.getElementById('addnew').addEventListener('click', function (e) {
                            form.appendChild(createField());
                            form.appendChild(document.createElement("br"));
                        });
                    </script>

                    <input type="submit" value="GO" class="btn btn-success">
                </div>
            </div>
        </form>
        </div>

    </body>
</html>
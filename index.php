<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/output.css">
    <link rel="icon" href="src/images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&family=Lexend&family=Podkova&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="src/js/popup.js"></script>
    <title>FIFA World Cup Morocco 2030™</title>

    <style>
        html {
            font-family: poppins;
        }

        #popupContent::-webkit-scrollbar {
            width: 0px;
            /* Set your preferred width */
        }
    </style>
</head>

<body>
    <!-- Popup Structure -->
    <div id="popup" class="fixed w-full h-full top-0 left-0  items-center flex justify-center bg-black bg-opacity-50 hidden z-50">
        <!-- Popup content -->
        <div id="popupContent" class="bg-white w-7/12 h-[80vh] flex flex-col justify-start items-center overflow-y-auto rounded-2xl md:h-fit">

        </div>
    </div>
    <!-- End of Popup -->
    <?php
    include("src/pages/header.html");
    ?>
    <div id="countries" class="tabs tabs-lifted p-1">
        <input type="radio" name="my_tabs_2" class="tab w-24 text-xl" aria-label="Teams" checked />
        <div class="tab-content bg-[#f3f1ef] border-base-300 rounded-box pb-10">
            <div class="join pb-10 flex justify-center">
                <input onclick="print('%');" class="w-20 join-item btn btn-square" type="radio" name="options" aria-label="All" checked />
                <input onclick="print('Africa');" class="w-20 join-item btn btn-square" type="radio" name="options" aria-label="Africa" />
                <input onclick="print('Europe');" class="w-20 join-item btn btn-square" type="radio" name="options" aria-label="Europe" />
                <input onclick="print('Asia');" class="w-20 join-item btn btn-square" type="radio" name="options" aria-label="Asia" />
                <input onclick="print('South America');" class="w-20 join-item btn btn-square" type="radio" name="options" aria-label="South America" />
                <input onclick="print('North America');" class="w-20 join-item btn btn-square" type="radio" name="options" aria-label="North America" />
                <input onclick="print('Australia');" class="w-20 join-item btn btn-square" type="radio" name="options" aria-label="Australia" />
            </div>
            <div id="gridContent" class="grid gap-16 w-[85%] md:w-[95%] mx-auto text-center child:h-32 grid-cols-2 sm:grid-cols-3 sm:gap-12 md:grid-cols-6 md:gap-4 lg:grid-cols-9 transition-transform ">
                <!-- content -->
            </div>

        </div>

        <input type="radio" onclick="print2();" name="my_tabs_2" class="tab w-24 text-xl" aria-label="Groups" />
        <div class="tab-content bg-[#f3f1ef] border-base-300 rounded-box p-3">
            <div id="groups" class="grid gap-16 w-[85%] md:w-[95%] mx-auto text-center md:gap-4 md:grid-cols-2 lg:grid-cols-3 transition-transform ">
                <!-- content -->
            </div>
        </div>
    </div>
    <?php
    include("src/pages/footer.html");
    ?>
    <script>
        function print2() {
            fetch('getContentGroups.php')
                .then((response) => response.text())
                .then((data) => {
                    document.getElementById("groups").innerHTML = data;
                })
                .catch((error) => console.error("Error:", error));
        }
    </script>
</body>


</html>
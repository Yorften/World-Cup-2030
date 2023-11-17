<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "worldcup2030";

// Check if the ID is provided in the request
if (isset($_GET['id']) && isset($_GET['token'])) {
    $countryId = $_GET['id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a statement to prevent SQL injection
    $sql = "SELECT countryName, countryImage, countryContinent, countryCapital, countryPopulation, groupId, playerId FROM countries WHERE countryId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $countryId); // "i" for integer parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = htmlspecialchars($row["countryName"]);
        $link = htmlspecialchars($row["countryImage"]);
        $continent = htmlspecialchars($row["countryContinent"]);
        $capital = htmlspecialchars($row["countryCapital"]);
        $population = htmlspecialchars($row["countryPopulation"]);
        $group = htmlspecialchars($row["groupId"]);
        $player = htmlspecialchars($row["playerId"]);

        // Output the fetched information (you can format this as needed)
        echo "
            <div class=\"bg-[#E8E8E8] w-7/12 fixed rounded-tr-2xl rounded-tl-2xl\">
                <div class=\"flex justify-end\">
                    <span onclick=\"closePopup()\" class=\"text-5xl font-bold cursor-pointer mr-2\">&times;</span>
                </div>
            </div>
            <div class=\"flex flex-col gap-5 items-center w-full mt-20\">
                <div class=\"w-full flex flex-col gap-5 justify-center items-center md:flex-row md:justify-evenly\">
                    <div class=\"border-2 border-black rounded-sm self-center\">
                        <img class=\"w-full\" src=\"{$link}\" alt=\"\">
                    </div>
                    <div class=\"flex flex-col gap-4\">
                        <h1 class=\"text-3xl\">$name</h1>
                        <p>Capital: $capital</p>
                        <p>Continent: $continent</p>
                        <p>Population: $population</p>
                    </div>
                </div>
            
            ";
        $sql  = "SELECT playerName, playerSurename, playerImage FROM players WHERE playerId = $player";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = htmlspecialchars($row["playerName"]);
            $lastname = htmlspecialchars($row["playerSurename"]);
            $link = htmlspecialchars($row["playerImage"]);

            echo "
                <div class=\"w-full flex items-center justify-evenly md:gap-32 mt-4\">
                    <div class=\"h-48 flex flex-col justify-start\">
                        <p class=\"capitalize text-2xl\">$name</p>
                        <p class=\"uppercase text-3xl font-semibold\">$lastname</p>
                    </div>
                    <div class=\"\">
                        <img src=\"{$link}\">
                    </div>
                </div>


            </div>
                ";
        } else {
            echo "Player information not found.";
        }
    } else {
        echo "Country information not found.";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}

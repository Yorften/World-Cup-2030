<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "worldcup2030";

if (isset($_GET['pattern'])) {
    $pattern = $_GET['pattern'];
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT countryId, countryName, countryImage, countryContinent, countryCapital, countryPopulation, groupId, playerId FROM countries WHERE countryContinent LIKE '$pattern'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $id = htmlspecialchars($row["countryId"]);
            $name = htmlspecialchars($row["countryName"]);
            $link = htmlspecialchars($row["countryImage"]);

            echo "
                    <a onclick=\"openPopup($id)\" class=\"cursor-pointer\">
                        <div class=\"flex flex-col gap-4\">
                            <div class=\"border-2 border-yellow-500 w-[80%] rounded-sm self-center\"><img class=\"\" src=\"{$link}\"></div>
                            <div class=\"text-xl font-semibold\">{$name}</div>
                        </div>
                    </a>";
        }
        echo "</div>";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}

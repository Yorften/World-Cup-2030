<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "worldcup2030";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT groups.groupId, groups.groupName, stades.stadeName
                     FROM groups
                     INNER JOIN stades ON Groups.stadeId = Stades.stadeId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultGroup = $stmt->get_result();

if (mysqli_num_rows($resultGroup) > 0) {
    while ($row = mysqli_fetch_assoc($resultGroup)) {
        $id = htmlspecialchars($row["groupId"]);
        $name = htmlspecialchars($row["groupName"]);
        $stade = htmlspecialchars($row["stadeName"]);

        echo "
                        <div class=\"flex flex-col items-center w-full border-2 bg-white rounded-xl\">
                            <div class=\"flex w-full justify-between px-4 pt-5 pb-5\">
                                <h3 class=\"text-xl font-semibold\">Group $name</h3>
                                <h3 class=\"text-lg\">$stade</h3>
                            </div>
                        
                        ";
        $sql = "SELECT * FROM countries WHERE groupId = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = htmlspecialchars($row["countryId"]);
                $name = htmlspecialchars($row["countryName"]);
                $link = htmlspecialchars($row["countryImage"]);

                echo "
                            <hr class=\"h-[2px] w-[90%] bg-gray-200 border-0 dark:bg-gray-300\">
                            <div class=\"flex items-center justify-between w-[80%] mx-auto py-2\">
                                <img onclick=\"openPopup($id)\" class=\"w-[15%] md:w-[10%] object-contain cursor-pointer border border-black\" src=\"$link\" >
                                <p class=\"text-lg\">$name</p>
                            </div>
                        
                                ";
            }
            echo "</div>";
        }
    }
}

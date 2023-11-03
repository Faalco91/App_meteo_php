
<?php 
    /*function fetchDataApiMeteo() {
        global $apiData;
        $apiURL = "https://api.openweathermap.org/data/2.5/weather?q=paris&appid=c79ee06fdd8f5d8a5dc85409ff9453a4";
        $res = file_get_contents($apiURL);
        $apiData = json_decode($res, true);
        echo "<script> console.log($res) </script>";

    }
    fetchDataApiMeteo();*/
    error_reporting(E_ERROR | E_PARSE); // Désactiver l'affichage des avertissements et des notifications

    $error_msg = "";
    $celcius = "";
    $town_name = "";
    $res = "";
    $icon = "";

    $sunny = "*";
    $cloudy = "☁️";
    $partly_cloudy = "⛅️";
    $rainy = "🌧️";
    $night_emoji = "🌑";
    $snowy = "🌨️";
    $sunrise_emoji = "🌅";
    $sunset_emoji = "🌇";


function getEmoji($weather){
    switch($weather){
        case "Clear" : 
            $emoji = "☀️";
            break;
        case "Snow" :
            $emoji = "🌨️";
            break;
        case "Rain" : 
            $emoji = "🌧️";
            break;
        case "Clouds" :
            $emoji = "☁️";
            break;
        case "Mist" : 
            $emoji = "🌁";
            break;
        default:
            $emoji = "";
    }
    return $emoji;
}

function getWeather($emoji){
    switch($emoji){
        case "☀️" : 
            $weather_name = "Sunny";
            break;
        case "🌨️" :
            $weather_name = "Snowy";
            break;
        case "🌧️" : 
            $weather_name = "Rainy";
            break;
        case "☁️" :
            $weather_name = "Cloudy";
            break;
        case "🌁" : 
            $weather_name = "Misty";
            break;
        default:
        $weather_name = "";
    }
    return $weather_name;
}


    if(isset($_POST["submit"])){

        if(empty($_POST["city"])){
            echo "Search for cities.";
        } else {

            $city = $_POST["city"];
            $api_key = "39ed47471842ab055457f850a1690cf4";
            $api_URL = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$api_key";
            $res = file_get_contents($api_URL);
            $apiData = json_decode($res, true);

            if($apiData["cod"] == 200){

                $celcius = round($apiData["main"]["temp"] - 273);
                $town_name = $apiData["name"];
                $icon = $apiData["weather"][0]["icon"];
                $real_feel = round($apiData["main"]["feels_like"] - 273);
                $wind_speed = $apiData["wind"]["speed"];
                $humidity = $apiData["main"]["humidity"];
                $visibility = $apiData["visibility"] / 1000;
                $lat = $apiData["coord"]["lat"];
                $long = $apiData["coord"]["lon"];
                $date = date("Y-m-d");
                $current_time = date("H:i");
                $sunrise = $apiData["sys"]["sunrise"];
                $sunrise_date = date("H:i", $sunrise);
                $sunset = $apiData["sys"]["sunset"];
                $sunset_date = date("H:i", $sunset);

                echo "<script>console.log($lat, $long)</script>";

                $weather_main = $apiData["weather"]["0"]["main"];

                $api_URL_2 = "https://api.openweathermap.org/data/3.0/onecall/day_summary?lat=$lat&lon=$long&date=$date&appid=$api_key";
                $res_2 = file_get_contents($api_URL_2);
                $apiData_2 = json_decode($res_2, true);

                    $morning = round($apiData_2["temperature"]["morning"] - 273);
                    $evening = round($apiData_2["temperature"]["evening"] - 273);
                    $afternoon = round($apiData_2["temperature"]["afternoon"] - 273);
                    $night = round($apiData_2["temperature"]["night"] - 273);
                    $temp_min = round($apiData_2["temperature"]["min"] - 273);
                    $temp_max = round($apiData_2["temperature"]["max"] - 273);

                    echo "<script>console.log($res_2)</script>";

                $api_URL_3 = "https://api.openweathermap.org/data/3.0/onecall?lat=$lat&lon=$long&appid=$api_key";
                $res_3 = file_get_contents($api_URL_3);
                $apiData_3 = json_decode($res_3, true);

                    $weather_day1 = $apiData_3["daily"]["1"]["weather"]["0"]["main"];
                    $weather_day2 = $apiData_3["daily"]["2"]["weather"]["0"]["main"];
                    $weather_day3 = $apiData_3["daily"]["3"]["weather"]["0"]["main"];
                    $weather_day4 = $apiData_3["daily"]["4"]["weather"]["0"]["main"];
                    $weather_day5 = $apiData_3["daily"]["5"]["weather"]["0"]["main"];
                    $weather_day6 = $apiData_3["daily"]["6"]["weather"]["0"]["main"];


                    $temp_min_day1 = round($apiData_3["daily"]["1"]["temp"]["min"] - 273);
                    $temp_max_day1 = round($apiData_3["daily"]["1"]["temp"]["max"] - 273);

                    $temp_min_day2 = round($apiData_3["daily"]["2"]["temp"]["min"] - 273);
                    $temp_max_day2 = round($apiData_3["daily"]["2"]["temp"]["max"] - 273);

                    $temp_min_day3 = round($apiData_3["daily"]["3"]["temp"]["min"] - 273);
                    $temp_max_day3 = round($apiData_3["daily"]["3"]["temp"]["max"] - 273);

                    $temp_min_day4 = round($apiData_3["daily"]["4"]["temp"]["min"] - 273);
                    $temp_max_day4 = round($apiData_3["daily"]["4"]["temp"]["max"] - 273);

                    $temp_min_day5 = round($apiData_3["daily"]["5"]["temp"]["min"] - 273);
                    $temp_max_day5 = round($apiData_3["daily"]["5"]["temp"]["max"] - 273);

                    $temp_min_day6 = round($apiData_3["daily"]["6"]["temp"]["min"] - 273);
                    $temp_max_day6 = round($apiData_3["daily"]["6"]["temp"]["max"] - 273);


                echo "<script>console.log($res_3)</script>";


                $emoji_day0 = getEmoji($weather_main);
                $emoji_day1 = getEmoji($weather_day1);
                $emoji_day2 = getEmoji($weather_day2);
                $emoji_day3 = getEmoji($weather_day3);
                $emoji_day4 = getEmoji($weather_day4);
                $emoji_day5 = getEmoji($weather_day5);
                $emoji_day6 = getEmoji($weather_day6);

                $weather_name_day0 = getWeather($emoji_day0);
                $weather_name_day1 = getWeather($emoji_day1);
                $weather_name_day2 = getWeather($emoji_day2);
                $weather_name_day3 = getWeather($emoji_day3);
                $weather_name_day4 = getWeather($emoji_day4);
                $weather_name_day5 = getWeather($emoji_day5);
                $weather_name_day6 = getWeather($emoji_day6);

                if ($current_time >= $sunset_date && $current_time <= $sunrise_date) {
                    $current_emoji = $night_emoji;
                } else {
                    $current_emoji = $emoji_day0;
                }

                
            } else {
                $error_msg = "Il y'a une erreur dans la saisie. Verifiez le nom de la ville.";
                $celcius = "";
                $town_name = "";
                $real_feel = "";
                $wind_speed = "";
                $humidity = "";
                $visibility = "";
            }

            echo "<script> console.log($res) </script>";

        } 
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Application météo</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="index.scss">
        <script src="https://kit.fontawesome.com/f48346f4af.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="main-container">

            <nav class="side-bar">
                <ul class="side-bar-list">
                    <p id="umbrella-logo">☂️</p>
                    <li class="icon-container">
                        <i class="icon fa-solid fa-cloud-sun-rain" style="color: #ffffff;"></i>
                        <p class="icon-sidebar-name">Weather</p>
                    </li>
                    <li class="icon-container">
                        <i class="icon fa-solid fa-list-ul" style="color: #ffffff;"></i>
                        <p class="icon-sidebar-name">Cities</p>
                    </li>
                    <li class="icon-container">
                        <i class="icon fa-solid fa-map" style="color: #ffffff;"></i>
                        <p class="icon-sidebar-name">Map</p>
                    </li>
                    <li class="icon-container">
                        <i class="icon fa-solid fa-sliders" style="color: #ffffff;"></i>
                        <p class="icon-sidebar-name">Settings</p>
                    </li>
                </ul>
            </nav>

            <section class="weatherOfDay-container">

                <form method="post" class="nav-bar-container">
                    <input type="text" name="city" class="nav-bar" value=<?php echo $city; ?>>
                    <input type="submit" name="submit" class="submit-city">
                    <p class="message-error"><?php echo $error_msg ?></p>
                </form>
            
                <div class="weatherOfDay-content">
                    <div class="main-information">  
                        <div class="town-temperature">
                            <div class="town">
                                <?php echo $town_name; echo "<br>"; ?>
                            </div>
                            <div class="temperature">
                                <?php echo (!empty($celcius) ? $celcius . "°" : "") ?>
                            </div>
                        </div>
                        <div class="img-weather">
                            <?php echo (!empty($current_emoji) ? $current_emoji : ""); ?>
                        </div>
                    </div>
                    <div class="day-forecast">
                        <p class="title-sections">TODAY'S FORECAST</p>
                        <div class="list-forecast">
                            <ul class="temp-throughout-day">
                                <li class="hour-throughout-day">12:00 AM</li>
                                <li class="weather-throughout-day"><?php echo $night_emoji; ?></li>
                                <li class="degree-throughout-day"><?php echo (!empty($night) ? $night."°" : ""); ?></li>
                            </ul>
                            <div class="vertical-bar"></div>
                            <ul class="temp-throughout-day">
                                <li class="hour-throughout-day"><?php echo (!empty($sunrise_date) ? $sunrise_date." AM" : ""); ?></li>
                                <li class="weather-throughout-day"><?php echo $sunrise_emoji; ?></li>
                                <li class="degree-throughout-day"><?php echo (!empty($morning) ? $morning."°" : ""); ?></li>
                            </ul>
                            <div class="vertical-bar"></div>
                            <ul class="temp-throughout-day">
                                <li class="hour-throughout-day">12:00 PM</li>
                                <li class="weather-throughout-day"><?php echo (!empty($emoji_day0) ? $emoji_day0 : ""); ?></li>
                                <li class="degree-throughout-day"><?php echo (!empty($afternoon) ? $afternoon."°" : ""); ?></li>
                            </ul>
                            <div class="vertical-bar"></div>
                            <ul class="temp-throughout-day">
                                <li class="hour-throughout-day"><?php echo (!empty($sunset_date) ? $sunset_date." PM" : ""); ?></li>
                                <li class="weather-throughout-day"><?php echo $sunset_emoji; ?></li>
                                <li class="degree-throughout-day"><?php echo (!empty($evening) ? $evening."°" : ""); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="air-conditions">
                        <p class="title-sections">AIR CONDITIONS</p>
                        <ul class="air-conditions-content">
                            <li class="air-container real-feel">
                                <div class="air-content">
                                    <i class="icons-air fa-solid fa-temperature-half"></i>
                                    <p class="air-icon-name">Real Feel</p>
                                </div>
                                <p class="air-stats"><?php echo (!empty($real_feel) ? $real_feel."°" : "" ); ?></p>
                            </li>
                            <li class="air-container wind">
                                <div class="air-content">
                                    <i class="icons-air fa-solid fa-wind"></i>
                                    <p class="air-icon-name">Wind</p>
                                </div>
                                <p class="air-stats"><?php echo (!empty($wind_speed) ? $wind_speed." km/h" : "" ); ?></p>
                            </li>
                            <li class="air-container rain-chance">
                                <div class="air-content">
                                    <i class="icons-air fa-solid fa-droplet"></i>
                                    <p class="air-icon-name">Humidity</p>
                                </div>
                                <p class="air-stats"><?php echo (!empty($humidity) ? $humidity."%" : "" ); ?></p>
                            </li>
                            <li class="air-container uv-index">
                                <div class="air-content">
                                    <i class="icons-air fa-solid fa-eye-low-vision"></i>
                                    <p class="air-icon-name">Visibility</p>
                                </div>
                                <p class="air-stats"><?php echo (!empty($visibility) ? $visibility." km" : ""); ?></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <section class="upcomingWeather-container">
                <div class="upcomingWeather-content">
                    <p class="title-sections">7-DAY FORECAST</p>
                    <div class="list-7day-forecast">
                        <ul class="upcoming-weather">
                            <li class="upcoming-weather-day">Today</li>
                            <li class="upcoming-weather-emoji"><p class="upcoming-emoji"><?php echo (!empty($emoji_day0) ? $emoji_day0 : "" ); ?></p> <p class="upcoming-name"><?php echo (!empty($weather_name_day0) ? $weather_name_day0 : "" ); ?></p></li>
                            <li class="upcoming-weather-degrees"><?php echo (!empty($temp_max) && !empty($temp_min) ? "<strong style='color: rgba(204, 204, 204, 0.9);'>" . $temp_max . "</strong>" . "/" . $temp_min : ""); ?></li>
                        </ul>
                        <div class="horizontal-bar"></div>
                        <ul class="upcoming-weather">
                            <li class="upcoming-weather-day">Tue</li>
                            <li class="upcoming-weather-emoji"><p class="upcoming-emoji"><?php echo (!empty($emoji_day1) ? $emoji_day1 : ""); ?></p><p class="upcoming-name"><?php echo (!empty($weather_name_day1) ? $weather_name_day1 : "" ); ?></p></li>
                            <li class="upcoming-weather-degrees"><?php echo (!empty($temp_max_day1) && !empty($temp_min_day1) ? "<strong style='color: rgba(204, 204, 204, 0.9);'>" . $temp_max_day1 . "</strong>" . "/" . $temp_min_day1 : ""); ?></li>
                        </ul>
                        <div class="horizontal-bar"></div>
                        <ul class="upcoming-weather">
                            <li class="upcoming-weather-day">Wed</li>
                            <li class="upcoming-weather-emoji"><p class="upcoming-emoji"><?php echo (!empty($weather_day2) ? $emoji_day2 : ""); ?></p><p class="upcoming-name"><?php echo (!empty($weather_name_day2) ? $weather_name_day2 : "" ); ?></p></li>
                            <li class="upcoming-weather-degrees"><?php echo (!empty($temp_max_day2) && !empty($temp_min_day2) ? "<strong style='color: rgba(204, 204, 204, 0.9);'>" . $temp_max_day2 . "</strong>" . "/" . $temp_min_day2 : ""); ?></li>
                        </ul>
                        <div class="horizontal-bar"></div>
                        <ul class="upcoming-weather">
                            <li class="upcoming-weather-day">Thu</li>
                            <li class="upcoming-weather-emoji"><p class="upcoming-emoji"><?php echo (!empty($emoji_day3) ? $emoji_day3 : ""); ?></p><p class="upcoming-name"><?php echo (!empty($weather_name_day3) ? $weather_name_day3 : "" ); ?></p></li>
                            <li class="upcoming-weather-degrees"><?php echo (!empty($temp_max_day3) && !empty($temp_min_day3) ? "<strong style='color: rgba(204, 204, 204, 0.9);'>" . $temp_max_day3 . "</strong>" . "/" . $temp_min_day3 : ""); ?></li>
                        </ul>
                        <div class="horizontal-bar"></div>
                        <ul class="upcoming-weather">
                            <li class="upcoming-weather-day">Fri</li>
                            <li class="upcoming-weather-emoji"><p class="upcoming-emoji"><?php echo (!empty($emoji_day4) ? $emoji_day4 : ""); ?></p><p class="upcoming-name"><?php echo (!empty($weather_name_day4) ? $weather_name_day4 : "" ); ?></p></li>
                            <li class="upcoming-weather-degrees"><?php echo (!empty($temp_max_day4) && !empty($temp_min_day4) ? "<strong style='color: rgba(204, 204, 204, 0.9);'>" . $temp_max_day4 . "</strong>" . "/" . $temp_min_day4 : ""); ?></li>
                        </ul>
                        <div class="horizontal-bar"></div>
                        <ul class="upcoming-weather">
                            <li class="upcoming-weather-day">Sat</li>
                            <li class="upcoming-weather-emoji"><p class="upcoming-emoji"><?php echo (!empty($emoji_day5) ? $emoji_day5 : ""); ?></p><p class="upcoming-name"><?php echo (!empty($weather_name_day5) ? $weather_name_day5 : "" ); ?></p></li>
                            <li class="upcoming-weather-degrees"><?php echo (!empty($temp_max_day5) && !empty($temp_min_day5) ? "<strong style='color: rgba(204, 204, 204, 0.9);'>" . $temp_max_day5 . "</strong>" . "/" . $temp_min_day5 : ""); ?></li>
                        </ul>
                        <div class="horizontal-bar"></div>
                        <ul class="upcoming-weather">
                            <li class="upcoming-weather-day">Sun</li>
                            <li class="upcoming-weather-emoji"><p class="upcoming-emoji"><?php echo (!empty($weather_day6) ? $emoji_day6 : ""); ?></p><p class="upcoming-name"><?php echo (!empty($weather_name_day6) ? $weather_name_day6 : "" ); ?></p></li>
                            <li class="upcoming-weather-degrees"><?php echo (!empty($temp_max_day6) && !empty($temp_min_day6) ? "<strong style='color: rgba(204, 204, 204, 0.9);'>" . $temp_max_day6 . "</strong>" . "/" . $temp_min_day6 : ""); ?></li>
                        </ul>
                    </div>
                </div>
            </section>

        </div>
    </body>
</html>
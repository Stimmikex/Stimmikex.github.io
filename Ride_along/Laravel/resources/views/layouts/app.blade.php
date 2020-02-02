@php
    use App\Http\Controllers\ProfileController;
@endphp

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $websiteName = 'Ride Request';

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <?php
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = trim($actual_link, '/');
        $page_name1 = substr($url, strrpos($url, '/')+1);
        $page_name2 = substr($page_name1, count($page_name1)-1, -4);

        // if($_SERVER['HTTPS'] !== 'on') {
        //     header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        //     exit();
        // }
        if(!Auth::guest()) {
            $user_id = Auth::getUser()['attributes']['id'];
            $user_img = ProfileController::get_profile_img($user_id);
        }
    ?>
    <header>
      <nav class="wrapper">
        <div class="logo"><a href="{{ url('/home') }}" class="home-button"><img src="{{ config('paths.icons') }}carpool.png"></a></div><!-- Logo -->
        <input type="checkbox" id="menu-toggle">
          <label for="menu-toggle" class="label-toggle"></label>
        </input>
        <ul>
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/about') }}">About us</a></li>
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
            @else
                <li><a href="{{ url('/profile')}}"><img src="{{ $user_img }}" class="header_img"> Profile <span class="notification_count"></span></a></li>
                <li><a href="{{ url('/logout') }}">Logout</a></li>
            @endif
        </ul>
      </nav>
    </header>
    <div class="content-wrap">
        <h3 align="center">THIS WEBSITE IS UNDER CONSTRUCTION!</h3>
            <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    @yield('content')

    </div>
    <footer>
        <div class="top-footer flex-container">
            <div class="col-1-2 footer-padding">
                <div id="dgi">
                </div>
            </div>
            <div class="col-1-2 flex-container footer-padding">
                <div class="col-1-2">
                    <?php
                        if(!Auth::guest()) {

                            $day = date("N") - 1;
                            $scheduleRes = DB::select("CALL get_dayplan($user_id, $day)");

                            echo '<ul class="footer_planner_ul">';
                            echo '<h4>'.$days[$day].'</h4>';
                            echo "<hr>";

                            if (empty($scheduleRes)) {
                                echo "Nothing on this day.";
                            }
                            else {
                                echo '<pre>';
                                for ($j = 0; $j < count($scheduleRes); $j++) {
                                    echo $scheduleRes[$j]->leaving. "<br>";
                                    $location_toRes = DB::table('location')->select('location_name')->where('id', $scheduleRes[$j]->to_id)->get();
                                    $location_fromRes = DB::table('location')->select('location_name')->where('id', $scheduleRes[$j]->from_id)->get();

                                    echo "To: ".$location_toRes[0]->location_name."<br>";
                                    echo "From: ".$location_fromRes[0]->location_name."<br>";
                                    echo "<hr>";
                                }
                                echo '</pre>';
                            }
                            echo '</ul>';

                        }


                        // $scheduleQuery = "SELECT weekplanner.day AS day, 
                        //                     weekplanner.leaving AS leaving, 
                        //                     weekplanner.to_id AS to_id, 
                        //                     weekplanner.from_id AS from_id, 
                        //                     weekplanner.plan_id AS plan_id,
                        //                     planner.id AS id
                        //                     FROM weekplanner
                        //                         JOIN planner ON weekplanner.plan_id=planner.id
                        //                     WHERE weekplanner.day = :day AND planner.user_id=:user_id";
                        // $scheduleRes = $db->prepare($scheduleQuery);
                        // $scheduleRes->bindParam(':day', $day);
                        // $scheduleRes->bindParam(':user_id', $userID);
                        // $scheduleRes->execute();

                        // $locationQuery = "SELECT name FROM location WHERE id = :location_id";
                        // $locationRes = $db->prepare($locationQuery);

                        // echo '<h4>'.$days[$day].'</h4>';
                        // echo '<ul class="footer_planner_ul">';

                        // while ($row = $scheduleRes->fetch(PDO::FETCH_ASSOC)) {
                        //     echo '<li class="footer_planner">Time: '.$row['leaving'].'<br>';
                        //     // echo $days[$day].", ".$row['leaving'].", ".$row['to_id'].", ".$row['from_id'].", ".$row['plan_id'];
                        //     $locationRes->bindParam(':location_id', $row['from_id']);
                        //     $locationRes->execute();
                            
                        //     while ($row2 = $locationRes->fetch(PDO::FETCH_ASSOC)) {
                        //         echo 'From: '.$row2['name'].'<br>';
                        //     }
                            
                        //     $locationRes->bindParam(':location_id', $row['to_id']);
                        //     $locationRes->execute();

                        //     while ($row2 = $locationRes->fetch(PDO::FETCH_ASSOC)) {
                        //         echo 'To: '.$row2['name'];
                        //     }
                        //     echo '</li>';
                        // }

                        // echo '</ul>';

                    ?>
                </div>
                <div class="col-1-2">
                    <p><b>WARNING!</b><br>You have to be 18 or older to use this site!<br>We are not responsible for anything our users do or say!</p>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <p class="copyright-text">&copy; 2016 | Styrmir Óli Þorsteinsson and Bjarki Fannar Snorrason</p>
        </div>
    </footer>
    <!-- <script src="js/plugins.js"></script>
    <script src="js/moment.js"></script> 
    <script src="js/geolocation.js"></script>
    <script src="js/google_maps.js"></script>
    <script src="js/notifications.js"></script>
    <script src="js/ism-2.2.min.js"></script> -->
    <script type="text/javascript">
        /*function update() {
            $('#dgi').html(moment().format('H:mm:ss'));
        }

        setInterval(update, 1000);*/
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

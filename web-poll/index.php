<?php include_once('includes/dbconnect.php');
global $conn;

$completedPoll = false;
$errors = "";


## Functions (normally I would have this in a separate file but for the assignment requirements it's all in this file)


/*   function insertResponses($conn, $concerns, $eq, $pan, $out) {
  
    $insertResponses = mysqli_query($conn, "INSERT INTO web_poll (concerns, eq, pandemic, outlook) VALUES ('$concerns', '$eq', '$pan', '$out')");
  
    return $insertResponses;
  }


  // get results from database  

   function getConcerns($conn) {
    $sql = "SELECT concerns FROM web_poll";
    $result = $conn->query($sql); 
    $concerns = array();
    while($row = $result->fetch_assoc()) {
      array_push($concerns, $row);
    }

    return $concerns;
   }


  // aggregate return data
  function tallyConcerns($concerns, $val) {
    $concernsArr[] = explode(",", $concerns);

     $count= 0;
      if(in_array($val, $concernsArr)) {
        $count++;
      }
   return $count;
  }
  
 function getEqResp($conn) {
  $sql = "SELECT eq FROM web_poll";
  $result = $conn->query($sql);
  $eqResp = array();
  while($row = $result->fetch_assoc()) {
    array_push($eqResp, $row);
  }

  return $eqResp;
 }

 function getPandemicResp($conn) {
  $sql = "SELECT pan FROM web_poll";
  $result = $conn->query($sql);
  $panResp = array();
  while($row = $result->fetch_assoc()) {
    array_push($panResp, $row);
  }

  return $panResp;
 }

 function getOutlookResp($conn) {
  $sql = "SELECT pan FROM web_poll";
  $result = $conn->query($sql);
  $outResp = array();
  while($row = $result->fetch_assoc()) {
    array_push($outResp, $row);
  }

  return $outResp;
 }
 
 
 */

 ##### POST FORM #####
if (empty($_POST)) {
  //  display regular version of page because they haven't submitted form yet
} else if (
  !empty($_POST['concerns']) && !empty($_POST['earthquake']) && !empty($_POST['pandemic']) && !empty($_POST['outlook'])
) {
  // all fields have been filled out so  display graphs
  $completedPoll = true;
  

  $concerns = $_POST['concerns'];
  $concernStr = implode(',', $concerns);

  $earthquakeResponse = $_POST['earthquake'];
  $eqStr = implode(',',$earthquakeResponse);

  $pandemicResponse = $_POST['pandemic'];
  $outlook = $_POST['outlook'];


 
  // set variables for charts



} else {
  $errors = true;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Web Poll</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

  
</head>

<body>
  <div id="header">
    <h1 class="centered">Web Poll</h1>
  </div>
  <div class="container">
    <p>2020 has been a wild ride so far. I want to know how it's going for you!</p>


    <div class="form-area">
      <!-- form area-->
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- beg of form-->
        <div class="form-row">
          <div class="form-group">
            <!-- issues question   -->
            <h3>Of the following, which issues concern you the most?</h3>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="climate" name="concerns[]" id="climate-change">
              <label class="form-check-label" for="climate-change">
                Climate Change
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="politics" name="concerns[]" id="politics">
              <label class="form-check-label" for="politics">
                Politics(corruption, current policies)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="healthcare" name="concerns[]" id="healthcare">
              <label class="form-check-label" for="healthcare">
                Healthcare(ease of access to quality care, affordable health insurance)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="education" name="concerns[]" id="education">
              <label class="form-check-label" for="education">
                Education(affordable tuition, quality material)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="pandemic" name="concerns[]" id="pandemic">
              <label class="form-check-label" for="pandemic">
                COVID19 Pandemic
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="earthquakes" name="concerns[]" id="earthquakes">
              <label class="form-check-label" for="earthquakes">
                Earthquakes
              </label>
            </div>
          </div> <!-- end of issues question -->
        </div>

        <div class="form-row">
          <div class="form-group">
            <!-- earthquake question -->
            <h3>How did the 5.7 earthquake affect you? (select all that apply)</h3>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="anxiety" name="earthquake[]" id="severe-anxiety">
              <label class="form-check-label" for="sever-anxiety">
                PTSD/Severe Anxiety
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="prepare" name="earthquake[]" id="be-prepared">
              <label class="form-check-label" for="be-prepared">
                Realize I need to be more prepared/have a plan in place
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="bunker" name="earthquake[]" id="bunker-move">
              <label class="form-check-label" for="bunker-move">
                I'm buying a bunker
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="fun" name="earthquake[]" id="fun">
              <label class="form-check-label" for="fun">
                It was fun
              </label>
            </div>

          </div> <!-- end of earthquake question-->
        </div>

        <div class="form-row">
          <div class="form-group">
            <!-- COVID question -->
            <h3>How do you feel about the COVID19 Pandemic?</h3>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="die" name="pandemic" id="panic">
              <label class="form-check-label" for="panic">
                We're all going to die!
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="scared" name="pandemic" id="scared">
              <label class="form-check-label" for="scared">
                I'm anxious/scared enough that it is interfering with my life/mental health
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="chill" name="pandemic" id="chill">
              <label class="form-check-label" for="chill">
                I'm staying informed and taking precautions, but not letting it control my life
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="jerk" name="pandemic" id="jerk">
              <label class="form-check-label" for="jerk">
                I don't care about it and I won't stay at home or practice social distancing
              </label>
            </div>

          </div> <!-- end of COVID question-->
        </div>

        <div class="form-row">
          <div class="form-group">
            <!-- 2020 current optimism check -->
            <h3>Considering all of the above, how optimistic are you about your life and the world?</h3>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="fantastic" name="outlook" value="fantastic">
              <label class="form-check-label" for="fantastic">
                Feeling fantastic! (and probably in denial)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="outlook" id="alright" value="alright">
              <label class="form-check-label" for="alright">
                It's going to be alright
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="outlook" id="meh" value="meh">
              <label class="form-check-label" for="meh">
                Meh
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="outlook" id="grim" value="grim">
              <label class="form-check-label" for="grim">
                Looking pretty grim
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="outlook" id="nah" value="nah">
              <label class="form-check-label" for="nah">
                I give up on life
              </label>
            </div>

          </div> <!-- end of 2020 current optimism check -->
        </div>

        <div class="form-row">
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>

    </div> <!-- end of form area--->

    <div class="charts"> <!-- google visualization of the results (will need to seed the DB with extra data) -->

    <div id="chart_div"></div>





    </div>

  </div>
</body>
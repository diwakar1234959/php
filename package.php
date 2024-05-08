  <?php
  require_once "db.php";

      session_start();
      if (isset($_SESSION['role'])== 'admin') {
        header("Location: dashboard.php");
        exit();
    }

      
      if (!isset($_SESSION['email'])) {
          header("Location: login.php");
          exit();
      }
      $email = $_SESSION['email'];

  $user_plan_sql = "SELECT u.subscription, p.package 
  FROM users u 
  LEFT JOIN packages p ON u.subscription = p.pac_id 
  WHERE u.email = '$email'";
  $user_plan_result = mysqli_query($con, $user_plan_sql);

  $current_plan = "";
  if ($user_plan_row = mysqli_fetch_assoc($user_plan_result)) {
      $current_plan = $user_plan_row['package'];
  }
  ?>

  <!DOCTYPE html>
      <title>Package</title>
      <head>
          <style>
              @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap");
  :root {
    --baseColor: #656c7c;
    --baseSize: 16px;
    --baseLineHeight: 1.5;
    --fontFamily: Inter, sans-serif;
    --pink: #ea4c89;
    --pinkLight: #ffecf0;
    --blue: #1769ff;
    --redTick: url("data:image/svg+xml,%3Csvg width='18' height='14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M16.552.134 5.717 10.97 1.448 6.701 0 8.149l5.717 5.717L18 1.583 16.552.134Z' fill='%23EA455F'/%3E%3C/svg%3E%0A");
    --whiteTick: url("data:image/svg+xml,%3Csvg width='18' height='14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M16.552.134 5.717 10.97 1.448 6.701 0 8.149l5.717 5.717L18 1.583 16.552.134Z' fill='%23FFFFFF'/%3E%3C/svg%3E%0A");
    --close: url("data:image/svg+xml,%3Csvg width='18' height='18' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M18 1.414 16.586 0 9 7.586 1.414 0 0 1.414 7.586 9 0 16.586 1.414 18 9 10.414 16.586 18 18 16.586 10.414 9 18 1.414Z' fill='%23B1B8C9'/%3E%3C/svg%3E");
    --entpIcon: url("data:image/svg+xml,%3Csvg width='42' height='42' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3.813 11.077 21 1.155l17.187 9.922v19.846L21 40.845 3.813 30.923V11.077Z' stroke='%23fff' stroke-width='2'/%3E%3Ccircle cx='21' cy='21' r='8' stroke='%23fff' stroke-width='2'/%3E%3C/svg%3E");
  }

  * {
    box-sizing: border-box;
  }

  html {
    color: var(--baseColor);
    font-family: var(--fontFamily);
    font-size: var(--baseSize);
    line-height: var(--baseLineHeight);
  }

  body {
    margin: 0;
    background-color:#ADD8E6;
  }

  .plans {
    width: 96%;
    max-width: 1128px;
    margin: 0 auto;
  }
  .plans__container {
    padding: 1rem 0 2rem;
  }

  .plansHero {
    text-align: center;
    padding: 5rem 0 4.5rem;
    line-height: 1.21;
  }
  .plansHero__title {
    font-weight: 700;
    font-size: 2rem;
    margin: 0 0 1rem 0;
    color: #000;
  }
  .plansHero__subtitle {
    margin: 0;
  }

  .planItem {
    --border: 1px solid #e6e6e6;
    --bgColor: #fff;
    --boxShadow: none;
    background-color: var(--bgColor);
    border: var(--border);
    border-radius: 1rem;
    box-shadow: var(--boxShadow);
    padding: 2rem 1.5rem;
    display: inline-flex;
    flex-direction: column;
  }
  .planItem__container {
    --direction: column;
    display: grid;
    grid-auto-flow: var(--direction);
    grid-auto-columns: 1fr;
    gap: 1.5rem;
  }
  .planItem .price {
    --priceMargin: 2rem 0;
  }
  .planItem--pro {
    --border: 0;
    --boxShadow: 0px 14px 30px rgba(204, 204, 204, 0.32);
  }
  .planItem--pro .label {
    --labelBg: #fdb72e;
    --labelColor: #fff;
  }
  .planItem--entp {
    --bgColor: var(--blue);
  }
  .planItem--entp .card {
    --titleColor: #fff;
    --descColor: rgb(255 255 255 / 80%);
  }
  .planItem--entp .card__icon {
    background-image: var(--entpIcon);
    background-size: cover;
  }
  .planItem--entp .price,
  .planItem--entp .featureList {
    --color: #fff;
  }
  .planItem--entp .featureList {
    --icon: var(--whiteTick);
  }
  .planItem .button {
    margin-top: auto;
  }

  .button {
    --bgColor: var(--pinkLight);
    --color: var(--pink);
    --shadowColor: rgb(234 76 137 / 30%);
    --outline: var(--pink);
    border-radius: 0.5rem;
    display: block;
    width: 100%;
    padding: 1rem 1.5rem;
    border: 0;
    line-height: inherit;
    font-family: inherit;
    font-size: 1rem;
    font-weight: 600;
    background-color: var(--bgColor);
    color: var(--color);
    cursor: pointer;
    transition: all 0.1s ease-in-out;
    -webkit-user-select: none;
      -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
  }
  .button--pink {
    --bgColor: var(--pink);
    --color: #fff;
    --shadowColor: rgb(234 76 137 / 50%);
  }
  .button--white {
    --bgColor: #fff;
    --shadowColor: rgb(255 255 255 / 30%);
    --outline: #fff;
  }
  .button:hover {
    transform: translateY(-2px);
    box-shadow: 0px 6px 10px var(--shadowColor);
  }
  .button:focus-visible {
    outline-offset: 2px;
    outline: 2px solid var(--outline);
  }

  .card {
    --titleColor: #000;
    --descColor: var(--baseColor);
  }
  .card__header {
    display: flex;
    gap: 1rem;
    align-items: center;
  }
  .card__icon {
    width: 2.625rem;
    height: 2.625rem;
  }
  .card h2 {
    color: var(--titleColor);
    font-size: 1.5rem;
    line-height: 1.2;
    font-weight: 400;
    margin: 0;
    flex-grow: 1;
  }
  .card__desc {
    margin: 1.5rem 0 0;
    color: var(--descColor);
  }

  .label {
    --labelColor: var(--baseColor);
    --labelBg: #e5e5e5;
    font-weight: 600;
    line-height: 1.25;
    font-size: 1rem;
    text-align: center;
    padding: 0.625rem 1.125rem;
    border-radius: 2rem;
    -webkit-user-select: none;
      -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
    background-color: var(--labelBg);
    color: var(--labelColor);
  }

  .price {
    --color: #000;
    --priceMargin: 0;
    display: flex;
    color: var(--color);
    align-items: center;
    gap: 0.5625rem;
    font-weight: 600;
    font-size: 2rem;
    margin: var(--priceMargin);
  }
  .price span {
    font-size: 1rem;
    font-weight: 400;
    color: var(--baseColor);
  }

  .featureList {
    --color: #000;
    --icon: var(--redTick);
    --height: 0.875rem;
    margin: 0 0 2.75rem;
    padding: 0;
    font-weight: 500;
  }
  .featureList li {
    color: var(--color);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  .featureList li:before {
    content: "";
    background-image: var(--icon);
    background-size: cover;
    display: block;
    width: 1.125rem;
    height: var(--height);
  }
  .featureList li:last-child {
    margin-bottom: 0;
  }
  .featureList li.disabled {
    --color: #b1b8c9;
    --height: 1.125rem;
    --icon: var(--close);
  }

  .symbol {
    --big: 2.625rem;
    --small: 1.5rem;
    --radius: 0.25rem;
    border: 2px solid var(--blue);
    width: var(--big);
    height: var(--big);
    border-radius: var(--radius);
    position: relative;
  }
  .symbol--rounded {
    --radius: 2rem;
  }
  .symbol:after {
    content: "";
    box-sizing: border-box;
    display: block;
    position: absolute;
    border: 2px solid var(--pink);
    width: var(--small);
    height: var(--small);
    border-radius: var(--radius);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  @media screen and (max-width: 640px) {
    .plans {
      max-width: 480px;
      width: 90%;
    }

    .planItem__container {
      --direction: row;
    }
  }
  @media screen and (min-width: 641px) and (max-width: 768px) {
    :root {
      --baseSize: 12px;
    }
  }
  @media screen and (min-width: 769px) and (max-width: 1080px) {
    :root {
      --baseSize: 14px;
    }
  }
  
              </style>
  </head>
  <body>
  <?php
  include('header.php');
  ?>
  <div class="package">
    <p style="text-align:center;font-size:50px;border:2px solid black;margin-left:200px;margin-right:200px;">Current plan: <?php echo $current_plan; ?></p>
    <?php
    require_once "db.php";

    // session_start();

    $sql = "SELECT * FROM packages";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <section class="plans__container">
          <div class="plans">
            <h1 class="plansHero__title" style="text-align:center">Gym Membership Plans</h1><br><br>

            <div class="planItem__container">

              <div class="planItem planItem--free">
                <input type="hidden" name="plan" value="<?php echo $row['package']; ?>">
                <div class="card">
                  <div class="card__header">
                    <div class="card__icon symbol symbol--rounded"></div>
                    <h2><?php echo $row['package']; ?></h2>
                  </div>
                  <!-- <div class="card__desc">Quartely Membership</div> -->
                </div>

                <div class="price">₹<?php echo $row['pac_price']; ?><span>for <?php echo $row['duration']; ?></span></div>

                <ul class="featureList">
                  <li>Locker</li>
                  <li>Weekly Free Steam Bath</li>
                  <li>Free Gym Accessories</li>
                  <li>Trainer support</li>
                </ul>
                <?php if ($current_plan != $row['package']) { ?>
                  <form method="post" action="package_in.php">
                    <button type="submit" name="plan" value="<?php echo $row['pac_id']; ?>" class="button" id="alertButton">Book</button>
                  </form>
                <?php } else { ?>
                  <p style="color: red;">You're already subscribed to this plan.</p>
                <?php } ?>
              </div>

            </div>
        <?php
      }
    }
        ?>
          </div>
        </section>
  </div>
  </body>

  <script>
    var button = document.getElementById("alertButton");

    button.addEventListener("click", function() {
      alert("Membership Booked!");
    });
  </script>
  </html>

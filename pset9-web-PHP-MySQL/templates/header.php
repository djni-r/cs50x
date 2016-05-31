<!DOCTYPE html>

<html lang="be">

    <head>

        <meta charset="utf-8">
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>Парафія Св. Кірыла і Мятода<?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Парафія Св. Кірыла і Мятода</title>
        <?php endif ?>
        
        <script src="/js/jquery-1.11.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>

    </head>

    <body>

        <div class="container">

            <div id="top">
                <a href="/"><img alt="Sv. Kiryla i Miatod" src="/img/temp_logo.jpg"/></a>
			</div>

            <div id="middle">
				<div>
					<ul class="nav nav-pills">
                        <!--<li><a id="menubtn" href="javascript:void(0);" class="topnav-localicons w3-left" onclick="openMenu()" title="Menu">☰</a></li>-->
						<li><a href="index.php">навіны</a></li>
						<li class="dropdown">
						        <button class="dropbtn">парафія</button>
                                <div class="dropdown-content">
                                    <a href="history.php">гісторыя</a>
                                    <a href="cim_history.php">Кірыла і Мятод</a>
                                    <a href="parish_list.php">запісацца ў спіс</a>
                                    <?php if(!empty($_SESSION["id"])) : ?>
                                        <a href="parish_list_admin.php">спіс парафіянаў</a>
                                    <?php endif ?> 
                                </div>
                         
                        </li>
						<li class="dropdown">
						        <button class="dropbtn">святар</button>
                                <div class="dropdown-content">
                                    <a href="minister.php">біяграфія</a>
                                    <a href="ask_question.php">задаць пытанне</a>
                                    <a href="blog.php">блог</a>
                                </div>
                         
                        </li>
						<li><a href="gallery.php">галерэя</a></li>
						<li><a href="contacts.php">кантакты</a></li>
						<li id="calendar" class="dropdown">
					        <button class="dropbtn">каляндар</button>
                            <div class="dropdown-content">
                                <p id="nav-date"><h1><?= $date["mday"] ?></h1><h4><?= translate_month($date["mon"]) ?></h4></p>
                                <p><h6><strong><?= $calendar["saints"] ?></strong></p>
                                <p><?= $calendar["read_day"] ?></p>
                                <p><?= $calendar["read_saints"] ?></p>
                                <a href="http://carkva-gazeta.by/calendar_month.php">поўны каляндар газеты "Царква"</a></h6>
                            </div>
                        </li>
						<li id="subscribe" class="dropdown">
					        <button class="dropbtn">падпісацца</button>
                            <div class="dropdown-content">
                                <p>
                                    <form action="subscribe.php" method="post">
                                        <input id="email" name="email" placeholder="імэйл" type="text"/><br>
                                        <button type="submit" class="dropbtn">падпісацца на навіны</button>     
                                    </form>
                                </p>
                            </div>
                        </li>
				    </ul><br>
				</div>

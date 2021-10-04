<?php 
	session_start();
	$dir = $_SERVER['DOCUMENT_ROOT'];
	require_once($dir.'/vendor/connection.php');
	//Ошибка авторизации
	if (isset($_SESSION['errorLogin'])){
		echo '
			<script>
				  $(document).ready(function(){
				    //открыть модальное окно с id="loginModal"
				  $("#loginModal").modal("show");
				});
			</script>';
	}
	// Ошибка регистрации
	if (isset($_SESSION['errorSignUp'])){
		echo '
			<script>
				  $(document).ready(function(){
				    //открыть модальное окно с id="myModal"
				  $("#signupModal").modal("show");
				});
			</script>';
	}
	// Успешная регистрация
	if (isset($_SESSION['signupSuccess'])){
		echo '
			<script>
				  $(document).ready(function(){
				    //открыть модальное окно с id="myModal"
				  $("#loginModal").modal("show");
				});
			</script>';
	}
	if(isset($_SESSION['appError'])){
		echo '
			<script>
				  $(document).ready(function(){
				    //открыть модальное окно с id="myModal"
				  $("#ApplicationModal").modal("show");
				});
			</script>';
	}
	if (isset($_SESSION['appSuccess'])){
		echo '
			<script>
				  $(document).ready(function(){
				    //открыть модальное окно с id="myModal"
				  $("#ApplicationModal").modal("show");
				});
			</script>';
	}
	if(isset($_SESSION['user'])){
		if($_SESSION['user']['isAdmin']==1){
			echo'
		  		<nav class="navbar navbar-expand-md navbar-light bg-light">
			  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
			          <span class="navbar-toggler-icon"></span>
			        </button>
			        <div class="navbar-collapse collapse" id="navbarCollapse" style="">
			      		<ul class="topmenu navbar-nav mr-auto">
			        		<li><a href="/index.php">Главная</a></li>
			        		<li><a href="/section/news/news.php">Новости</a></li>
			        		<li><a href="/section/protection-and-prevention/protection-and-prevention.php">Защита и профилактика</a></li>
			        		<li><a href="/section/state-support/state-support.php">Государственная помощь</a></li>
			        		<li><a href="/section/volunteer-support/volunteer-support.php">Волонтерская помощь</a></li>
			        		<li><a href="/section/usefull-links/usefull-links.php">Полезные ссылки</a></li>
			        		<li><a href="/section/faq/faq.php">Часто задаваемые вопросы (FAQ)</a></li>
			        		<li class="d-none d-sm-block"><a href="/my-account.php" class="submenu-link">Мой профиль</a>
			          			<ul class="submenu">
			          				<li><a href="/application/application.php">Заявки</a></li>
			          				<li><a href="/application/sended-applications.php">Поданные заявки</a></li>
			          				<li><a href="/organization/organization.php">Организации</a></li>
			            			<li><a href="/admin/article-create.php">Создать новую статью</a></li>
			            			<li><a href="/application/my-applications.php">Мои заявки</a></li>
			            			<li><a href="/vendor/logout.php">Выйти</a></li>
			          			</ul>
			          		</li>
			          		<li class="d-block d-sm-none"><a href="/my-account.php" class="submenu-link">Мой профиль</a></li>
			          		<li class="d-block d-sm-none"><a href="/application/application.php">Заявки</a></li>
	          				<li class="d-block d-sm-none"><a href="/application/sended-applications.php">Поданные заявки</a></li>
	          				<li class="d-block d-sm-none"><a href="#">Организации</a></li>
	            			<li class="d-block d-sm-none"><a href="/admin/article-create.php">Создать новую статью</a></li>
	            			<li class="d-block d-sm-none"><a href="/application/application-create-page.php">Создать новую форму заявки</a></li>
	            			<li class="d-block d-sm-none"><a href="/application/my-applications.php">Мои заявки</a></li>
	            			<li class="d-block d-sm-none"><a href="/vendor/logout.php">Выйти</a></li>
			          	</ul>
			        </div>
		    	</nav>';
		}
		else{
			echo '
		  		<nav class="navbar navbar-expand-md navbar-light bg-light">
			  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
			          <span class="navbar-toggler-icon"></span>
			        </button>
			        <div class="navbar-collapse collapse" id="navbarCollapse">
			      		<ul class="topmenu navbar-nav mr-auto">
			        		<li><a href="/index.php">Главная</a></li>
			        		<li><a href="/section/news/news.php">Новости</a></li>
			        		<li><a href="/section/protection-and-prevention/protection-and-prevention.php">Защита и профилактика</a></li>
			        		<li><a href="/section/state-support/state-support.php">Государственная помощь</a></li>
			        		<li><a href="/section/volunteer-support/volunteer-support.php">Волонтерская помощь</a></li>
			        		<li><a href="/section/usefull-links/usefull-links.php">Полезные ссылки</a></li>
			        		<li><a href="/section/faq/faq.php">Часто задаваемые вопросы (FAQ)</a></li>
			        		<li class="d-none d-sm-block"><a href="/my-account.php" class="submenu-link">Мой профиль</a>
			          			<ul class="submenu">
			          				<li><a href="/application/my-applications.php">Мои заявки</a></li>
			            			<li><a href="/vendor/logout.php">Выйти</a></li>
			          			</ul>
			          		</li>
			          		<li class="d-block d-sm-none"><a href="/my-account.php" class="submenu-link">Мой профиль</a></li>
			          		<li class="d-block d-sm-none"><a href="/application/my-applications.php">Мои заявки</a></li>
			            	<li class="d-block d-sm-none"><a href="/vendor/logout.php">Выйти</a></li>
			          	</ul>
			        </div>
		    	</nav>';
		}
	} 
	else{
		if(!isset($_SESSION['user'])){
			echo '
		  		<nav class="navbar navbar-expand-md navbar-light bg-light">
			  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
			          <span class="navbar-toggler-icon"></span>
			        </button>
			        <div class="navbar-collapse collapse" id="navbarCollapse" style="">
			      		<ul class="topmenu navbar-nav mr-auto">
			        		<li><a href="/index.php">Главная</a></li>
			        		<li><a href="/section/news/news.php">Новости</a></li>
			        		<li><a href="/section/protection-and-prevention/protection-and-prevention.php">Защита и профилактика</a></li>
			        		<li><a href="/section/state-support/state-support.php">Государственная помощь</a></li>
			        		<li><a href="/section/volunteer-support/volunteer-support.php">Волонтерская помощь</a></li>
			        		<li><a href="/section/usefull-links/usefull-links.php">Полезные ссылки</a></li>
			        		<li><a href="/section/faq/faq.php">Часто задаваемые вопросы (FAQ)</a></li>
			        		<li class="d-none d-sm-block"><a href="#" class="submenu-link">Мой профиль</a>
			          			<ul class="submenu">
			            			<li><a href="#" data-toggle="modal" data-target="#loginModal">Авторизация</a></li>
			            			<li><a href="#"data-toggle="modal" data-target="#signupModal">Регистрация</a></li>
		          				</ul>
			          		</li>
			          		<li class="d-block d-sm-none"><a href="#" data-toggle="modal" data-target="#loginModal">Авторизация</a></li>
			            	<li class="d-block d-sm-none"><a href="#"data-toggle="modal" data-target="#signupModal">Регистрация</a></li>
			          	</ul>
			        </div>
		    	</nav>';
		}
	}
	?>
	
<div id="loginModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Авторизация</h3>
        <a href="#" title="Close" class="close" data-dismiss="modal">&times;</a>
      </div>
      <div class="modal-body">
      	<form action="/vendor/login.php" method="post">    
        	<label>Электронная почта</label>
	        <input type="email" class="form-control" name="loginEmail" aria-describedby="emailHelp" 
	        placeholder="Введите адрес электронной почты">
	        <small id="emailHelp" class="form-text text-muted">Какая-то инфа...</small>
	        <label>Пароль</label>
	    	<input type="password" class="form-control" name="loginPassword" placeholder="Введите пароль">
	    	<br>
	    	<?php
	    		if (isset($_SESSION['errorLogin'])) {
	    		 	echo '<label class="alert alert-danger">Ошибка! Неверный логин или пароль</label><br>';
	    		 	unset($_SESSION['errorLogin']);
	    		 }
	    		 if (isset($_SESSION['signupSuccess'])) {
	    		 	echo '<label class="alert alert-success">'.$_SESSION['signupSuccess'].'</label><br>';
	    		 	unset($_SESSION['signupSuccess']);
	    		 } 
	    		?>
	    	<button type="submit" class="btn btn-primary">Войти</button>
	   </form>
	  </div>	    
    </div>
  </div>
</div>

<div id="signupModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Регистрация</h3>
        <a href="#" title="Close" class="close" data-dismiss="modal">&times;</a>
      </div>
      <div class="modal-body">
      	<form action="vendor/signup.php" method="post">    
	        <label>Электронная почта</label>
	        <input type="email" name="signupEmail" class="form-control" aria-describedby="emailHelp" placeholder="Введите адрес электронной почты">
	        <small id="emailHelp" class="form-text text-muted">Какая-то инфа...</small>
	        <label>Пароль</label>
	    	<input type="password" name="signupPassword" class="form-control" placeholder="Введите пароль">
	    	<label>Подтвердите пароль</label>
	    	<input type="password" name="signupPasswordConfirm" class="form-control" placeholder="Введите пароль">
	    	<label>Фамилия</label>
	    	<input type="text" name="signupSurname" class="form-control" placeholder="Введите фамилию">
	    	<label>Имя</label>
	    	<input type="text" name="signupName" class="form-control" placeholder="Введите имя">
	    	<label>Отчество</label>
	    	<input type="text" name="signupPatronymic" class="form-control" placeholder="Введите имя">
	    	<label>Контактный телефон</label>
	    	<input type="phone" name="signupPhone" class="form-control" placeholder="Введите контактный телефон">
	    	<br>
	    	<p>Регистрируясь на данном портале вы соглашаетесь с <a href="/section/article.php?id=12">политикой обработки персональных данных данных</a></p>
	    	<?php
	    		if (isset($_SESSION['errorSignUp'])) {
	    		 	echo '<label class="alert alert-danger">'.$_SESSION['errorSignUp'].'</label><br>';
	    		 	unset($_SESSION['errorSignUp']);
	    		 } 
	    		?>
	  		<button type="submit" class="btn btn-primary">Зарегистрироваться</button>
  		</form>
      </div>
    </div>
  </div>
</div>

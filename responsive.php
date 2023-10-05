<!DOCTYPE html>
<html>
<head>
<title>Responsivo</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

[class*="col-"] {
  float: left;
  padding: 15px;
}

html {
  font-family: "Lucida Sans", sans-serif;
}

.header {
  background-color: #ffffff;
  color: #ffffff;
  padding: 15px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.menu li:hover {
  background-color: #0099cc;
}

.menu a:link {
	text-decoration:none;
}

.central {
	height: 500px;
    width: 500px;
	border:0;
}

.aside {
  background-color: #33b5e5;
  padding: 15px;
  color: #ffffff;
  text-align: center;
  font-size: 14px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.footer {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 60px;
  background-color: #0099cc;
  color: #ffffff;
  text-align: center;
  font-size: 12px;
  padding: 15px;
}

/* For mobile phones: */
[class*="col-"] {
  width: 100%;
}

@media only screen and (min-width: 600px) {
  /* For tablets: */
  .col-s-1 {width: 8.33%;}
  .col-s-2 {width: 16.66%;}
  .col-s-3 {width: 25%;}
  .col-s-4 {width: 33.33%;}
  .col-s-5 {width: 41.66%;}
  .col-s-6 {width: 50%;}
  .col-s-7 {width: 58.33%;}
  .col-s-8 {width: 66.66%;}
  .col-s-9 {width: 75%;}
  .col-s-10 {width: 83.33%;}
  .col-s-11 {width: 91.66%;}
  .col-s-12 {width: 100%;}
}
@media only screen and (min-width: 768px) {
  /* For desktop: */
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
}
</style>
</head>
<body>

<div class="header">
  <a class="navbar-brand" href="http://www.edificiochurchill.com.br" target="_blank"> <img src="img/churchill-minor.png" class="img-rounded" alt="Winston Churchill" width="60" height="60" hspace="10"></a>
</div>

<div class="row">
  <div class="col-3 col-s-3 menu">
    <ul>
      <a href='cadastrovisitantes.php' target="central"><li> Cadastro </li></a>
      <li>Baixa</li>
      <li>Localizza</li>
      <li>Carona</li>
    </ul>
  </div>

  <div class="col-9 col-s-12 central" id="">
	<iframe name="central" id="central" src="index2.php" style="width:100%;height:100%;border:0;overflow:hidden"></iframe>
  </div>

</div>

<div class="footer">
  <p>Mude o tamanho da janela do navegador para testar a visualização.</p>
</div>

</body>
</html>
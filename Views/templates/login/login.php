<?php 
  $titulo='Login';
  require_once('Views/default/header.php'); 

?>
<!-- aca ira todo el codigo html de la vista-->


<div class="row" style="margin: 0px;">
  <div class="col col-sm-12"  style="margin: 0px!important; padding: 0px!important;">
    
    <form class="col col-sm-4" style="margin: auto;" action="<?php echo $server;?>/auth" method="POST">

      <h1 class="h3 mb-3 font-weight-normal" style="margin-top: 85px;">Login</h1>

      <div class="form-group">
        <label for="exampleInputEmail1">nombre de usuario</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="user">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Contraseña</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
  </div>
</div>
<!---hasta aca -->

<?php require_once('Views/default/footer.php'); ?>
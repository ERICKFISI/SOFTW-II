<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="login/validar">
              <h1>Formulario de Login</h1>
              <div>
                <input type="text" class="form-control" name="usuario" placeholder="Usuario" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="contra" placeholder="Contraseña" required="" />
              </div>
              <div>
                <input class="btn btn-default submit"  type="submit" value="Ingresar"></input>
                <a class="reset_pass" href="#">Olvidaste tu contraseña?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Nuevo en el sitio?
                  <a href="#signup" class="to_register"> Crear cuenta </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Moto repuestos J&C!</h1>
                  <p>©2020 Todos los derechos reservados. Moto repuestos J&C! </p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Crear cuenta</h1>
              <div>
                <input type="text" class="form-control" placeholder="Usuario" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Correo" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Contraseña" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Aceptar</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Ya estas registrado?
                  <a href="#signin" class="to_register">Ingresa </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Moto repuestos J&C!</h1>
                  <p>©2020 Todos los derechos reservados. Moto respuestos J&C! </p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>

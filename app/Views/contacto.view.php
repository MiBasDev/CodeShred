<!--Main-->
<main class="cs-fl-col cs-fl-align-c cs-fl-just-c">
    <section class="">
        <div class="">
            <h3 class="">CONTACTO</h3>
            <article class="">
                <form action="/contacto" method="post">
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <div class="">
                            <label for="name"><i class=""></i></label>
                            <input type="text" name="name" placeholder="Nombre">
                        </div>

                        <div class="">
                            <label for="surname"><i class=""></i></label>
                            <input type="text" name="surname" placeholder="Apellidos">
                        </div>
                        <div class="">
                            <label for="email"><i class=""></i></label>
                            <input type="email" name="email" placeholder="Email">
                        </div>
                    <?php } ?>
                    <div class="">
                        <label for="subject"><i class=""></i></label>
                        <input type="text" name="subject" id="subject"></input>
                    </div>
                    <div class="">
                        <label for="message"><i class=""></i></label>
                        <textarea name="message" id="message" rows="10" class="" length="255" ></textarea>
                    </div>

                    <div class="">
                        <button class="button button-secondary" type="submit"><i class=""></i>Enviar</button>
                    </div>

                </form>

            </article>
        </div>
    </section>
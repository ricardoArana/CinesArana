<x-guest-layout>
    <style>
        body {
            font-family: 'Work Sans', sans-serif;
        }

        .faq-heading {
            margin-left: 20%;
            margin-right: 20%;
            opacity: 0.96;
            background-color: white;
            border-bottom: black;
            padding: 20px 60px;
        }

        .faq-heading:hover {
            opacity: 1
            ;

        }

        .faq-container {
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .hr-line {
            width: 60%;
            margin: auto;

        }

        /* Style the buttons that are used to open and close the faq-page body */
        .faq-page {
            box-shadow: #000c92 2px 1px 3px 1px;
            background-color: white;
            opacity: 0.96;
            color: black;
            cursor: pointer;
            padding: 30px 20px;
            width: 60%;
            border: none;
            outline: none;
            transition: 0.4s;
            margin: auto;
        }

        .faq-body {
            margin: auto;
            /* text-align: center; */
            width: 50%;
            padding: auto;

        }

        /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
        .active,
        .faq-page:hover {
            background-color: white;
            opacity: 1;
        }

        /* Style the faq-page panel. Note: hidden by default */
        .faq-body {
            padding: 0 18px;
            color: white;
            background-color: black;
            display: none;
            overflow: hidden;
            border: #000c92 solid 3px;

        }

        .faq-page:after {
            content: '\02795';
            /* Unicode character for "plus" sign (+) */
            font-size: 13px;
            color: #777;
            float: right;
            margin-left: 5px;
        }

        .active:after {
            content: "\2796";
            /* Unicode character for "minus" sign (-) */
        }

        h1 {
            margin: 15px 0;
            font-weight: 400;
            font-size: 20px;
        }

        .testbox {
            display: flex;
            justify-content: center;
            align-items: center;
            height: inherit;
            padding: 3px;
        }

        input,
        select,
        textarea {
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input:hover,
        select:hover,
        textarea:hover {
            outline: none;
            box-shadow: 0 0 5px 0 white;
        }

        input {
            width: calc(100% - 10px);
            padding: 5px;
        }

        select {
            width: 100%;
            padding: 7px 0;
            background: transparent;
        }

        textarea {
            width: calc(100% - 2px);
            paddung: 5px;
        }

        .item {
            position: relative;
            margin: 10px 0;
        }

        .item:hover p,
        .item:hover i {
            color: white;
        }

        input:hover,
        select:hover,
        textarea:hover {
            box-shadow: 0 0 10px 0 #000c92;
        }

        .status:hover input {
            box-shadow: none;
        }

        .status label:hover input {
            box-shadow: 0 5px 0 #000c92;
        }

        .status-item input,
        .status-item span {
            width: auto;
            vertical-align: middle;
        }

        .status-item input {
            margin: 0;
        }

        .status-item span {
            margin: 0 20px 0 5px;
        }

        input[type="date"]::-webkit-inner-spin-button {
            display: none;
        }

        input[type="time"]::-webkit-inner-spin-button {
            margin: 2px 22px 0 0;
        }

        .item i,
        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            font-size: 20px;
            color: #a9a9a9;
        }

        .item i {
            right: 1%;
            top: 30px;
            z-index: 1;
        }
        .btn-block {
      margin-top: 20px;
      text-align: center;
      }
    #boton-enviar{
        width: auto;
        padding: 10px;
        border: none;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background-color: white;
        font-size: 16px;
        color: black;
        cursor: pointer;
    }
      #boton-enviar:hover{

      background-color: black;
      color: white;
      box-shadow: 0 0 5px 0 white;
      }
      #form-contacto{
        width: 70%;
    padding: 20px;
    background: black;
    color: white;
    opacity: 0.96;
    box-shadow: 0 2px 5px #ccc;
      }
        }

        @media (min-width: 568px) {
            .name-item {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .name-item input {
                width: calc(50% - 20px);
            }
        }
    </style>

    <body>
        <main style="padding-top: 2%">
            <h1 class="faq-heading text-2xl text-center">Preguntas Frecuentes</h1>
            <section class="faq-container">
                <div class="faq-one">
                    <!-- faq question -->
                    <h1 class="faq-page">¿Qué puedo encontrar en este apartado?</h1>
                    <!-- faq answer -->
                    <div class="faq-body">
                        <p>En esta página encontrarás las preguntas más frecuentes entre los usuarios, si no encuentras
                            lo que buscas no dudes en enviar un correo electrónico a nuestra dirección.</p>
                    </div>
                </div>
                <hr class="hr-line">
                <div class="faq-two">
                    <!-- faq question -->
                    <h1 class="faq-page">¿Hay ofertas para el miércoles?</h1>
                    <!-- faq answer -->
                    <div class="faq-body">
                        <p>No tenemos ofertas para ningún día de la semana aún, pero podéis aprovechar las continuas
                            promociones que anunciamos, ¡deberías estar al tanto del correo electrónico! &#128231;
                            &#128064;</p>
                    </div>
                </div>
                <hr class="hr-line">
                <div class="faq-three">
                    <!-- faq question -->
                    <h1 class="faq-page">¿Puedo devolver las entradas compradas?</h1>
                    <!-- faq answer -->
                    <div class="faq-body">
                        <p>Lo sentimos pero no disponemos de un sistema de devolución de entradas, puedes probar a
                            escribirnos al correo electrónico por si podemos ayudarte.</p>
                    </div>
                </div>
                <hr class="hr-line">
                <div class="faq-four">
                    <!-- faq question -->
                    <h1 class="faq-page">¿Qué pasa si no puedo asistir a la película que he reservado?</h1>
                    <!-- faq answer -->
                    <div class="faq-body">
                        <p>No tienes de que preocuparte, sólo que no podrás recuperar el dinero de la entrada.</p>
                    </div>
                </div>
            </section>
        </main>
        <div>

        </div>
        <div class="testbox" style="margin-top: 5%">
            <form id="form-contacto"
                action="{{ route('send.email') }}" method="post">
                @csrf
                <h1>Formulario de contacto</h1>
                <div class="item">
                    <p>Nombre completo:</p>
                    <div class="name-item">
                        <input type="text" name="name" placeholder="Nombre" />
                    </div>
                </div>
                <div class="item status">
                    <p>Relación del contacto:</p>
                    <div class="status-item">
                        <label><input type="checkbox" name=""> <span>Entradas</span></label>
                        <label><input type="checkbox" name=""> <span>Pago</span></label>
                        <label><input type="checkbox" name=""> <span>Otro</span></label>
                    </div>
                </div>
                <div class="item">
                    <p>Asunto del email:</p>
                    <input type="text" name="subject" placeholder="Asunto" />
                    <p>Correo electrónico:</p>
                    <input type="text" name="email" />
                </div>
                <div class="item">
                    <p>Teléfono:</p>
                    <input type="text" name="telefono" />
                </div>

                <div class="item">
                    <p>Escribe tu mensaje:</p>
                    <textarea name="content " rows="5"></textarea>
                </div>
                <div class="btn-block">
                    <input id="boton-enviar" value="Enviar correo"
                        type="submit" href="/">
                </div>
            </form>
        </div>
    </body>
    <script defer>
        var faq = document.getElementsByClassName("faq-page");
        var i;
        for (i = 0; i < faq.length; i++) {
            faq[i].addEventListener("click", function() {
                /* Toggle between adding and removing the "active" class,
                to highlight the button that controls the panel */
                this.classList.toggle("active");
                /* Toggle between hiding and showing the active panel */
                var body = this.nextElementSibling;
                if (body.style.display === "block") {
                    body.style.display = "none";
                } else {
                    body.style.display = "block";
                }
            });
        }
    </script>
</x-guest-layout>

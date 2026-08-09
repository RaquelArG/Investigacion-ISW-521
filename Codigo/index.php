<?php

$counterFile = __DIR__ . '/counter.txt';
$requestCount = file_exists($counterFile) ? (int) file_get_contents($counterFile) : 0;
$requestCount++;
file_put_contents($counterFile, $requestCount);

$renderedAt = date('d/m/Y H:i:s');
$requestId  = bin2hex(random_bytes(4));
$phpVersion = phpversion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>¿Qué es SSR? — Demostración en vivo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrap">

    <div class="topbar">
      <span><span class="dot"></span><b>servidor</b> · PHP</span>
      <span>render #<?= $requestCount ?></span>
    </div>

    <header class="hero">
      <p class="eyebrow">Guía técnica</p>
      <h1>Esto que estás leyendo<br>lo escribió el servidor.</h1>
      <p class="lede">
        Server-Side Rendering (SSR) es la técnica en la que el HTML de una página
        se genera en el servidor, en el momento de la petición, en vez de armarse
        después en el navegador con JavaScript. Esta misma página es un ejemplo
        real: cada vez que la recargas, el servidor vuelve a construir el documento
        desde cero y te lo entrega ya completo.
      </p>

      <div class="proof">
        <span class="corner tl"></span><span class="corner br"></span>
        <div class="pulse-row">
          <span class="node">🧭 navegador</span>
          <span class="beam"></span>
          <span class="node">GET /</span>
          <span class="beam"></span>
          <span class="node">🖥️ servidor</span>
          <span class="beam"></span>
          <span class="node">HTML listo</span>
        </div>

        <div class="proof-data">
          <div>
            <span class="k">Renderizado en</span>
            <span class="v"><?= $renderedAt ?></span>
          </div>
          <div>
            <span class="k">Petición N.º</span>
            <span class="v">#<?= $requestCount ?></span>
          </div>
          <div>
            <span class="k">ID de petición</span>
            <span class="v"><?= $requestId ?></span>
          </div>
        </div>

        <p class="proof-note">
          Estos tres valores se calculan dentro de <code>index.php</code> justo
          antes de responder. Si desactivas JavaScript en el navegador y recargas,
          seguirán apareciendo actualizados — porque no dependen del cliente.
        </p>
      </div>
    </header>

    <section class="block">
      <div class="block-head">
        <span class="tag">01</span>
        <h2>¿Qué es exactamente SSR?</h2>
      </div>
      <p>
        En una aplicación con <strong>Server-Side Rendering</strong>, el servidor
        ejecuta la lógica de la vista (plantillas, datos, condiciones) y produce
        un documento HTML completo antes de enviarlo. El navegador solo tiene
        que pintarlo: no necesita esperar a que se descargue y ejecute un bundle
        de JavaScript para ver el contenido. Esto contrasta con el
        <strong>Client-Side Rendering (CSR)</strong>, donde el servidor manda un
        HTML casi vacío y es el navegador quien construye la página con JS.
      </p>
    </section>

    <section class="block">
      <div class="block-head">
        <span class="tag">02</span>
        <h2>El recorrido de una petición SSR</h2>
      </div>
      <div class="timeline">
        <div class="tstep" data-n="1">
          <h3>El navegador pide una URL</h3>
          <p>Se envía una petición <code>GET</code> normal, igual que a cualquier página web tradicional.</p>
        </div>
        <div class="tstep" data-n="2">
          <h3>El servidor recibe la petición</h3>
          <p>Ejecuta el código de la página: consulta datos, aplica lógica y arma el estado a mostrar.</p>
        </div>
        <div class="tstep" data-n="3">
          <h3>Se genera el HTML</h3>
          <p>El código del servidor combina los datos con las etiquetas HTML y produce el documento final, byte por byte.</p>
        </div>
        <div class="tstep" data-n="4">
          <h3>El HTML completo viaja al navegador</h3>
          <p>La respuesta ya trae el contenido visible; no depende de que el JavaScript del cliente se ejecute primero.</p>
        </div>
        <div class="tstep" data-n="5">
          <h3>El navegador pinta la página</h3>
          <p>El contenido aparece de inmediato. Si hace falta interactividad, JavaScript puede añadirse después, sin volver a construir el HTML.</p>
        </div>
      </div>
    </section>

    <section class="block">
      <div class="block-head">
        <span class="tag">03</span>
        <h2>SSR frente a CSR</h2>
      </div>
      <table class="compare">
        <thead>
          <tr>
            <th>Aspecto</th>
            <th>Server-Side Rendering</th>
            <th>Client-Side Rendering</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>¿Dónde se genera el HTML?</th>
            <td class="good">En el servidor, por petición</td>
            <td class="bad">En el navegador, con JS</td>
          </tr>
          <tr>
            <th>Primer contenido visible</th>
            <td class="good">Rápido: llega ya renderizado</td>
            <td class="bad">Espera a descargar y ejecutar JS</td>
          </tr>
          <tr>
            <th>SEO</th>
            <td class="good">Los buscadores ven el contenido directo</td>
            <td class="bad">Puede requerir renderizado adicional</td>
          </tr>
          <tr>
            <th>Carga del servidor</th>
            <td class="bad">Mayor: renderiza en cada petición</td>
            <td class="good">Menor: solo sirve archivos estáticos</td>
          </tr>
          <tr>
            <th>Navegación entre páginas</th>
            <td class="bad">Suele recargar el documento</td>
            <td class="good">Muy fluida, sin recargas</td>
          </tr>
        </tbody>
      </table>
    </section>

    <section class="block">
      <div class="block-head">
        <span class="tag">04</span>
        <h2>Ventajas y desventajas</h2>
      </div>
      <div class="grid2">
        <div class="card pos">
          <h3>A favor</h3>
          <ul>
            <li>Carga inicial más rápida, sobre todo en redes lentas.</li>
            <li>Mejor indexación para buscadores, porque el HTML ya trae el contenido.</li>
            <li>Funciona incluso con JavaScript desactivado o con dispositivos limitados.</li>
            <li>Las vistas previas de enlaces (redes sociales, chats) leen el contenido real.</li>
          </ul>
        </div>
        <div class="card neg">
          <h3>En contra</h3>
          <ul>
            <li>Más trabajo para el servidor, que renderiza en cada visita.</li>
            <li>La navegación entre páginas puede sentirse menos fluida que en una SPA.</li>
            <li>Requiere un entorno de servidor activo, no basta con archivos estáticos.</li>
            <li>Añadir interactividad después del render implica coordinar HTML y JS.</li>
          </ul>
        </div>
      </div>
    </section>

    <section class="block">
      <div class="block-head">
        <span class="tag">05</span>
        <h2>Dónde se usa</h2>
      </div>
      <p>Lenguajes y frameworks que aplican SSR de forma habitual:</p>
      <div class="chips">
        <span class="chip"><b>PHP</b> · esta demo</span>
        <span class="chip"><b>Next.js</b> · React</span>
        <span class="chip"><b>Nuxt</b> · Vue</span>
        <span class="chip"><b>Django</b> · Python</span>
        <span class="chip"><b>Ruby on Rails</b> · Ruby</span>
        <span class="chip"><b>ASP.NET</b> · C#</span>
      </div>
    </section>

    <footer>
      <span>demostración de SSR</span>
      <span>php <?= $phpVersion ?></span>
    </footer>
  </div>

  <script src="script.js"></script>
</body>
</html>

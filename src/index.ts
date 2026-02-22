addEventListener("fetch", (event) => {
  event.respondWith(
    new Response("Hola desde mi Worker!", {
      headers: { "Content-Type": "text/plain" },
    })
  );
});
const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"home":{"uri":"\/","methods":["GET","HEAD"]},"hub":{"uri":"hub","methods":["GET","HEAD"]},"lorequestion.index":{"uri":"question","methods":["GET","HEAD"]},"lorequestion.roleplay":{"uri":"question\/roleplay","methods":["GET","HEAD"]},"submitAnswer":{"uri":"questions\/submit","methods":["POST"]},"startGame":{"uri":"questions","methods":["GET","HEAD"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };

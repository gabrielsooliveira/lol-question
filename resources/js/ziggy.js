const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"home":{"uri":"\/","methods":["GET","HEAD"]},"hub":{"uri":"hub","methods":["GET","HEAD"]},"lorequestion.index":{"uri":"lorequestion","methods":["GET","HEAD"]},"lorequestion.roleplay":{"uri":"lorequestion\/roleplay","methods":["GET","HEAD"]},"submitAnswer":{"uri":"lorequestion\/submit","methods":["POST"]},"startGame":{"uri":"lorequestion\/start","methods":["GET","HEAD"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };

# force-physical-location-visit

This small proof of concept PHP tool can force you to visit a certain physical
location for several days. This is done by generating QR codes that have to
be scanned on each day. If not scanned, you loose an important password.
When these QR codes are placed at a certain location, you will have to visit
that location.

To make cheating harder, this tool generates an unique QR code for each day
because you may find the old QR codes in your browser history.

## License

Licensed under either of these:

 * Apache License, Version 2.0, ([LICENSE-APACHE](LICENSE-APACHE) or
   https://www.apache.org/licenses/LICENSE-2.0)
 * MIT license ([LICENSE-MIT](LICENSE-MIT) or
   https://opensource.org/licenses/MIT)

# force-physical-location-visit

![grafik](https://github.com/user-attachments/assets/2d734824-36f5-4bbb-b141-a7747196a3e6)

This proof of concept JavaScript tool is designed to require visits to a specific physical location over several days. It works by generating a unique QR code that must be scanned each day. If you fail to scan the QR code, you will lose an important password. The QR codes are placed at a specific location, which you will need to visit to scan them. To prevent cheating, the tool generates a unique QR code for each day, making it more difficult to reuse old codes found in your browser history.

Check it out! https://772.github.io/force-physical-location-visit/

## Proof of concept

This is just a proof of concept. If you have basic development knowledge, you can exploit this website. A more robust solution would require a server to securely store and update the password file as needed.

## Related ideas

Without QR codes, a website could check the gps position and return another hyperlink each day. But this would allow people to use fake gps data.

## License

Licensed under either of these:

 * Apache License, Version 2.0, ([LICENSE-APACHE](LICENSE-APACHE) or
   https://www.apache.org/licenses/LICENSE-2.0)
 * MIT license ([LICENSE-MIT](LICENSE-MIT) or
   https://opensource.org/licenses/MIT)

## Contribution

Unless you explicitly state otherwise, any contribution intentionally submitted for inclusion in the work by you, as defined in the Apache-2.0 license, shall be dual licensed as above, without any additional terms or conditions.

## TODO

- Only one QR code and warn about browser history. It is less secure but many qr codes suck.
- Using GithubActions password to prevent cheating for users.
- Make this a Rust wasm app to hide internal passwords even better?

- This project is the backend API for the [Actuatuor-Control-Frontend](https://github.com/WaelKYoussef/Actuatuor-Control-Frontend)  project.

- The file in `RasPiRunner` (`main.py`) is the main runner file to be hosted on RaspberryPi and to automatically run on
startup through via `sudo vi /etc/rc.local` and adding `sudo python <script location> &`.

- The `SQL` containes the code required to create the database and all tables required on a MariaDB installation.

- This project uses pins `23` and `24` on the RaspberryPi along with a 2-Channel Relay module.

- Follow the diagram to connect the relays to the RasPi.

![Where is the Diagram ?](RasPiRunner/Diagram.png?raw=true "Diagram")

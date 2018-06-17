# Squisto Online Restaurant

[![N|Solid](https://image.ibb.co/jo05jd/logo.png)](https://nodesource.com/products/nsolid)

Squisto is a third-party company which has planned to offer a common online platform for offering the best deals of online meals ordering. The Online platform will allow users to register and maintain an online profile on the Squisito Website, Registered users can view and order a curated collection of meals from different restaurants.

The restaurants whose Squisito service is based upon are also offering their meals as a service. The service provided by these restaurants would then be utilized by Squisto to offer a combined curated meal service to its users. Registered users can login to see their recently ordered items, order new meals from multiple restaurants, view a meal's details, view a restaurant's details and pay by using a credit card. Currently, they are 3 restaurants from which meals can be curated but the site administrator can login to the admin portal to add more restaurants or edit / delete existing restaurants. View reports on user’s orders per restaurant per day. 

   - Bluechillies
   - CrazyBuzz
   - Moolight




# Deployment

Deploying the project requires some setup. The web services have hardcoded url to their SOAP server in their respective WSDL files. Therefore, a virtual host is required for the 4 web services, including Squisito's. Also because of the way CodeIgniter serves static files, a website domain name is required. This is set in the file `/application/config/config.php`
It should represent the name of the virtual domain. The current value is http://squisto.ralph/ which is the name of the virtual host defined for Squisito. 

# Database

The database for Squisito website have its connection credentials in the file `/application/config/databases.php`. The connection credentials can be changed as appropriate. The 4 database SQL files are located in the folder `'Database'`. 


# Implementation Procedures:

1.	Extract the contents of the project's zip archive containing the whole project: " Squisito.zip"
2.	The folder named `'webservices'` contains the folder for the other three restaurants' web services `(bluechillies, Crazybuzz, Moonlight)`. Remove this folder and put its contents (3 folders) into your site directory.
3.	From the database folder, import the SQL files for the 4 databases. The names of the databases correspond with the name of the files.
4.	Create a virtual host for each of the 3 restaurants, the vhost directory should point to the root of each folder, containing the 'images' and 'webservice' folder. The site names should be  `bluechillies.ralph`, `crazybuzz.ralph` and `moonlight.ralph`. These URLs are already hard-coded in the WSDL files.
5.	Move the whole Squisito folder to your site directory. Create a virtual host for Squisito, the name of the website should be `squisito.ralph`. The URL is again hardcoded in the WSDL file. The vhost directory should point to the public folder inside the vhost folder.
6.	You might need to modify the database connection credentials. For the 3 web services, the credentials are located inside the file /webservice/index.php. The credentials are declared in the constructor of the webservice class.
7.	For the admin portal, it is located at /admin and the default credentials are `admin:pass`
# /etc/hosts 
```sh
127.0.0.1       squisto.ralph
127.0.0.1       bluechillies.ralph
127.0.0.1       crazybuzz.ralph
127.0.0.1       moonlight.ralph
```

# vhost 
```sh
<VirtualHost *:80>
    ServerAdmin webmaster@squisito.ralph
    DocumentRoot "/Applications/MAMP/htdocs/squisto/"
    ServerName squisto.ralph
</VirtualHost>

<VirtualHost *:80>
    ServerAdmin webmaster@bluechillies.ralph
    DocumentRoot "/Applications/MAMP/htdocs/squisto/webservices/bluechillies/"
    ServerName bluechillies.ralph
</VirtualHost>

<VirtualHost *:80>
    ServerAdmin webmaster@crazybuzz.ralph
    DocumentRoot "/Applications/MAMP/htdocs/squisto/webservices/crazybuzz/"
    ServerName crazybuzz.ralph
</VirtualHost>

<VirtualHost *:80>
    ServerAdmin webmaster@moonlight.ralph
    DocumentRoot "/Applications/MAMP/htdocs/squisto/webservices/moonlight/"
    ServerName moonlight.ralph
</VirtualHost>
```


### Tech

Squisto uses a number of open source projects to work properly:

* [Codeigniter Framework] - PHP framework
* [Sublime Text Editor] - A sophisticated text editor for code, markup and prose
* [jQuery] - Javascript Library

And of course Dillinger itself is open source with a [public repository][dill]
 on GitHub.





### Development

Want to contribute? Great!

Squisto uses CodeIgniter for fast developing.
Make a change in your file and instantanously see your updates!


#
License
----

GNU General Public License v3.0


**Free Software, Hell Yeah!**


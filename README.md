# Dash Button Project

## 1. Introduction

Portera’s Dash Button is a Wi-Fi connected device that operates seamlessly integrated with the web server and cloud server and places an order with the press of a button. Each Dash Button is paired with a user, whose personal information and device ID is kept in the server after the sign-up process. Hence, the button allows user to place an order by using Cloud systems and IoT solutions. When the order process is completed, the user also gets notified about the order via SMS.

The dash button can be specialized to any activity that functions online and supports web servers. It allows users to do one task with a click of a button, and the limits of its use is unbounded. However, in this very brief documentation, in order to exemplify one of its most useful use cases functions and work flows related to the ordering process via dash button will be covered.


## 2. Design

The Dash Button device is simply an electrical circuit that contains a Particle Photon device, a momentary switch button and a 220Ω resistor with an approximately error rate ±5%. Furthermore, it can be powered up by any power source using voltage between 3.6V and 5.5V. For the sake of simplicity, three serially connected AA batteries (1.5V×3 = 4.5V) are used to build the prototype of the project.

<img src="https://github.com/bkaankuguoglu/DashButton/blob/master/Images/DashButton_Sketch.jpg" width="500">

*(Figure: Sketch of the dash button on an half breadboard)*

<img src="https://github.com/bkaankuguoglu/DashButton/blob/master/Images/DashButton_Sketch_Mini.jpg" width="500">

*(Figure: Sketch of the dash button on a mini breadboard)*



## 3. Implementation

### 3.1. Tools

- [Particle Photon](https://www.particle.io/)
- [CakePHP 3.2](http://cakephp.org/)
- [Twilio](https://www.twilio.com/)

Particle Photon device and utilities offered with the package is used for Wi-Fi and cloud configuration with the dash button. In addition to using PHP on the backend, the device is coded in C++ since it’s widely compatible to most existing platforms. Further, SMS functionality is implemented via one of the most popular Global SMS applications provider called Twilio.

On the server side, CakePHP, an open source framework for rapid application development, is used to build the web server, since it is integrated with the database and, with the help of Model-View-Controller pattern, it handles other web protocols easily with less effort.

The server simply holds the data related to users and their personal information paired with their unique device ids. Hence, this uniqueness allows the server to call the ordering process for the dash button owner. As the the dash button is pushed, it posts the device id and the the time that is published at to the server. Then, server retrieves the device id and looks it up on the Devices table, where all the device ids and their owners’ personal information is held. If the device id sent by the dash button exists in the database, then it triggers the ordering process as well as notifying the user about the process via SMS.

![alt tag](https://github.com/bkaankuguoglu/DashButton/blob/master/Images/HowCakePHP.png)

*(Figure: How CakePHP works)*

### 3.2. Building the Dash Button

As shown in the Design section, the dash button can be built by using both mini and half breadboards, or any breadboard tools in general. Aiming to implement a prototype that satisfies all the functionalities and requirements as well as keeping the size of the artifact as minimal as possible, the project is built by using mini and half breadboards. With the last prototype built by using mini breadboard, the dimensions of the dash button stand as 72×56×32mm, which is quite handy for a prototype.

![alt tag](https://github.com/bkaankuguoglu/DashButton/blob/master/Images/Prototype_half.png)

*(Figure: Prototype of the dash button using an half breadboard)*

![alt tag](https://github.com/bkaankuguoglu/DashButton/blob/master/Images/Prototype_mini.png)

*(Figure: Prototype of the dash button using a mini breadboard)*

### 3.3. Coding the Dash Button

The formal particle file has “.ino” extension to its name and it is just C++ with some make-up but nothing too complex. Usually, there are two main methods in the file, namely start and loop, and if you have had already an experience with C or C++ , this concept must be so familiar to you. A particle device firstly calls the lines of code and sets up the variables in the start function, then indefinitely iterates the lines in the loop method. A coder can always define new methods, global variables and simply do whatever he can do in standard C language.

Once a developer finishes the coding and wishes to program the device, before flashing it to the device, the code must be compiled beforehand in case of any errors. Fortunately, Particle IDE always compiles the code before flashing and aborts without programming the device if any error is found. Yet a developer may want to compile her/his code without programming the device. In this case, “Compile in cloud” operation can be used to detect errors, if there are any. Otherwise, it is always possible to “Flash” the program to the device, so you can easily observe the outputs.

Yet another significant concept that helps us build particle devices is webhooks. Webhooks are quite simple and also flexible way to transfer data from your Particle devices to other apps and services around the Internet. In our project, we mostly used webhooks to send forms to our server, so to say. In doing so, we could integrate the physical and digital world, in other words our dash buttons, with the cloud server provided by Particle.

There are many different ways for creating a webhooks, however, the two of these methods are more convenient among others. Firstly, Particle Dashboard web interface offers a way to create webhooks, and also to manage them. The second approach, which I find it more convenient and easily modifiable, is creating webhooks via terminal commands, after creating a “.json” file on your computer. Since your Particle Desktop IDE is nothing but a specialized version of Atom, a widely used open source text editor, developers can always open a new tab on their desktop IDE and create their webhooks recipe without even bothering to open their web browser. Likewise, manipulating webhooks can also be done via Particle Dashboard or terminal/console on your computer.

Last but not least, manipulating webhooks can easily get messy considering that modifying webhooks are not as straight forward as creating or deleting them. In fact, you cannot edit the webhook you already created, yet you can delete it and create a new webhook with the same name. However, since it is possible to create a webhook with a duplicate name, a developer must carefully check which webhook she/he publishes with their code. If possible, the duplications on webhook must be avoided for the sake of consistency of the system.

### 3.4. Twilio API

Twilio enables our application to send text and multimedia messages globally via its Programmable SMS service. Further, it allows its users to have a local, mobile, toll-free, or short code phone numbers for their applications. To start with, it is strongly recommended to go through the [tutorials](https://www.twilio.com/docs/tutorials) and read the [documentation](https://www.twilio.com/docs/api/rest/sending-messages) first.

Twilio is one of the most common Global SMS/MMS platform, possibly the most popular one, and it stands out with its user-friendly interface and widely available libraries for development among other alternatives. In our application, it is our design choice to send text messages from a script, on the other hand, the same functionality could be obtained by calling Twilio API from the particle file. Moreover, it is possible to call Twilio API from a PHP script whereas it is also possible to achieve similar results using *Curl, Ruby, Python, Node.js, Java, C#* and some other programming languages.

As seen in the figure, the variables Account Sid and Authorization Token for the API must be obtained beforehand to use the Twilio Services. Twilio also provides us with a template code that sends a text message to a specific phone number on its website. Nevertheless, the example script provided by Twilio is not enough for some requirements in our project. Thus, the code is modified by adding the date that the order is received to the text message. Furthermore, in order to create a generic call method, the query that finds the user’s data stored in the database is added by using the methods CakePHP provides. As a matter of fact, these two cases are achieved by retrieving the time *(published_at)* and the device id *(particle_long)* data from the post request that is sent to the server via our dash button

## 4. Installation
### 4.1. For Users

To install the dash button, assuming that the design and the implementation steps are done and the device operates correctly, the user must sign up to the server. Device id(key), name of the device, owner’s first name and last name, and the owner’s phone number. Then, the user can start using her/his dash button.

### 4.2. For Developers

To develop a dash button, developer must form the circuit first, as described in the Design section. Then, Particle IDE must be downloaded from here, or Particle Web IDE can also be used. Whereas the web IDE offers easy use with no installation or any configuration, the desktop IDE provides a better platform for complex projects. After setting up the developing platform, it is strongly suggested to complete and read the documentation available on Particle’s website.

## 5. Examples

### 5.1. Dash Button Implementation for Text Crawler

#### 5.1.1. Introduction
Portera’s Dash Button is a Wi-Fi connected device that operates seamlessly integrated with the web server and cloud server, and, similar to the order dash button, send a request to the server with a click of the button. Hence, the button allows the user, that is the presenter in our case, to send a request to start the presentation with a long sliding text stream. In this very tiny case, how the components of the system and the system work are well documented in order to provide users a brief background of the project. The work flow of the system can be observed from the figure below.

After the dash button is pushed, it creates the data stored in json format and sends a request to the server with the help of webhooks. Then, the request is received by the server via Firebase, which asynchronously listens request and keeps the webpage up to date with the changes, and the validity of the request is checked by evaluating the form being sent in the same request. In so doing, the possibility of interruption by any other source but our devices is eliminated. When the request is found to be “safe”, the web page is updated via call by Firebase. By using the Firebase plugin, AngularFire, AngularJS enables us to make changes on the web page on real time without refreshing.

![alt tag](https://github.com/bkaankuguoglu/DashButton/blob/master/Images/TextCrawlerDiagram.png)

*(Figure: How the system works)*

#### 5.1.2. Design & Implementation

##### 5.1.2.a. Tools

- [Particle Photon](https://www.particle.io/)
- [CakePHP 3.2](http://cakephp.org/)
- [AngularJS](https://angularjs.org/)
- [Firebase](https://firebase.google.com/)
- [AngularFire](https://github.com/firebase/angularfire)
- [AngularJS Bindings for Firebase](https://github.com/ktamas77/firebase-php)

![alt tag](https://github.com/bkaankuguoglu/DashButton/blob/master/Images/TextCrawlerWorkingEnv.png)

*(Figure: Environment in the Development Phase)*


Portera’s Dash Button prototype that has been created earlier is used as a remote controller that sends a request to the server. Thus, Particle Photon device and utilities offered with the package is used for Wi-Fi and cloud configuration with the dash button.

For agile development and rapid application growth, the open source PHP framework CakePHP is used to compose the application its MVC pattern that is integrated to a database. Moreover, in order to update our website with the requests sent to the server, it is required to have an asynchronous listener that observes all the request traffic between the server and the devices, and therefore changes the the page accordingly. While Firebase is utilized to capture requests from the devices and to keep the web page updated on the backend, AngularJS, with its Firebase plugin AngularFire, enabled us to change the view of the web page and start the text stream. Since all the lines of the text are stored in the database and therefore called one by one, users will see the same web page regardless of the time they opened the page.

The Database simply holds the data related to Device ID and the time the request being sent. Hence, this uniqueness allows the web page to be started by some specific sources, but other devices that can also send request to the same server. As the dash button is pushed, it posts the device id and the the time that is published at to the server. Then, server retrieves the device id and after checking the validity of the request, it triggers the application on the page.

Before moving the web application to the web server, it has been implemented on the local host enabled by Oracle VirtualBox, Vagrant, and Laravel Homestead. For more information on how the local server is built using these tools, several documentations for  [Laravel Homestead](https://laravel.com/docs/master/homestead) and [installing CakePHP on the Laravel Homestead](http://www.justinatack.com/blog/2015/install-cakephp3-laravel-homestead/) are available online.
Building the Dash Button

The code for the ordering process is used with small manipulations, but the main frame is still the same. After creating a webhook that will carry the data needed to send a proper request, the button is ready to launch. The new webhook is also similar to the one that is used for the ordering process, however, not it sends a POST request to our website. Since the project is developed locally, it was not possible to send/receive requests to the localhost using webhooks. Thus, [Ultrahook](http://www.ultrahook.com/) web services is used for this purpose.

##### 5.1.2.b. Back-end

Firebase is a platform that provides developers an environment where they can easily develop high-quality applications and integrate their apps using numerous different web/mobile services available with little effort. However, in our project, the use of Firebase SDK is limited to some core services and functionalities provided by Firebase Platform.
In order to create a webpage that asynchronously seeks for the changed made in the Database and therefore apply the corresponding changes on the front-end, it is essential to design a project that enables website to interact the database in real time. Therefore, Real-time Database feature provided by Firebase platform is used for the operations on the back-end.

On the back-end side, two end points are created in the Controller file, VisitsController.php to handle and operate request received at both end points. Whereas the end point “test” receives the request sent from the dash button and pushes the data to Firebase, the other end point “code” only holds a place to initiate a directory homestead.app/Visits/code and also to change the layout for the corresponding webpage.

##### 5.1.2.c. Front-end

For functionality tests, the design of the webpage is kept as simple as possible and therefore only the core requirements for the project is implemented first. Following two screenshots of the webpage before and after the button is clicked demonstrates how the web page will change after it is triggered. The text stream is arbitrarily filled with a random text from the internet.

On the front-end side, AngularJS, a structural JavaScript framework for dynamic web apps, is used to bind and also to synchronize components of the application dynamically. Further, the presence of the existing bindings, AngularFire, that allow developers to use Firebase platform much easier and more efficient in both time and effort also played a role on this decision. More information can be grasped from the source code provided in the following figures.

## 6. Support

For more information or any questions regarding Portera’s dash button, you can contact dashbutton@portera.com, or bkaankuguoglu@gmail.com .

## 7. Version
1.0.0

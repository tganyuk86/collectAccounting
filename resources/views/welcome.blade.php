@extends('layouts.app')

@section('content')

                <div id='cssmenu'>
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="#">About</a></li>
<li><a href="#">Contact</a></li>
<li><a href="Login.php">Login</a></li>
</ul>
</div>
<section id="mainheader">
<headerlogin>
<h1>collectaccounting</h1>
<p>Secure Cloud storage</p>
</headerlogin>
</section>
<section class="containerhome">
<h2 class="hidden"></h2>
<article id="slider_content1">
<h3>Get a real-time view of your cashflow</h3>
<p>Log in online anytime, anywhere on your Mac, PC, tablet or phone and see up-to-date financials. It’s accounting software that’s simple, smart and occasionally magical.</p>

</article>

<article id="slider_content2">
<h3>Invoices and expenses</h3>
<p>Use mobile or PC to reconcile, send invoices, create expense claims – from anywhere.</p>
</article>

<article id="slider_content3">
<h3>Reporting in seconds</h3>
<p>You can export directories files,reports in PDF formart and Graphs</p>
</article>

<div id="slides">
<img src="./img/slide_1.jpg" alt="Some alt text">
<img src="./img/slide_2.jpg" alt="Some alt text">
<img src="./img/slide_3.jpg" alt="Some alt text">
</div>
</section>

<section id="spacerhome">
<h2 class="hidden"></h2>
<p>Secure Online accounting site</p>
<div class="search">
<a href="Login.php"><input id="shiny" type="submit" name="submitbutton" value="access account" /></a>
</div>
</div>
</section>
<section id="boxcontenthome">
<h2 class="hidden"></h2>
<article>
<img src="./img/iconc.png" alt="alt text" width="50"/>
<h3>Invoicing</h3>
<p>
upload scanned invoices in a matter of moments and manage them within the system.</p>
</article>
<article>
<img src="./img/icona.png" alt="alt text" width="50"/>
<h3>Expenses</h3>
<p>
Purchases and expenses allow you to enter details of the money owed to suppliers and other company expediture.</p>
</article>

<article>
<img src="./img/iconb.png" alt="alt text" width="50"/>
<h3>Mobile accounting</h3>
<p>
Whether you're at home, on the bus or in a cafe, you'll have access to your online accounting data wherever you are.</p>
</article>


<br class="clear"/>
</section>
<section id="four_columns">
<h2>****</h2>
<article class="img-item">
<h3 class="hidden"></h3>
<figure>
<a href="./img/Powersmall.jpg" rel="lightbox" title="Some Title">
<span class="thumb-screen"></span>
<img src="./img/Powersmall.jpg" alt="Some alt text"/></a>
<figcaption>
<strong>For the self-employed</strong>
Clear Books is the easiest way to look after your finances. It’s affordable, it’s all online and it’s easy.</figcaption>
</figure>
</article>

<article class="img-item">
<h3 class="hidden"></h3>
<figure>
<a href="./img/Citysmall.jpg" rel="lightbox" title="Some Title">
<span class="thumb-screen"></span>
<img src="./img/Citysmall.jpg" alt="Some alt text"/></a>
<figcaption>
<strong>
Financial reports</strong>
Create yearly and monthly records.Manage them more efficiently and view up to date net income.</figcaption></figure>
</article>

<article class="img-item">
<h3 class="hidden"></h3>
<figure>
<a href="./img/Seasmall.jpg" rel="lightbox" title="Some Title">
<span class="thumb-screen"></span>
<img src="./img/Seasmall.jpg" alt="Some alt text"/></a>
<figcaption>
<strong>
Exports</strong>
Generate Pdf reports,Graphs and exportation of directory with all it subdirectories and files .</figcaption></figure>
</article>
<br class="clear"/>
</section><br/>

<footer>
<h2 class="hidden">Our footer</h2>
<section id="copyright">
<h3 class="hidden">Copyright notice</h3>
<div class="wrapper">&copy; Copyright 2015 by GoonsApp. All Rights Reserved.</div>
</section>
<section class="wrapper">
<h3 class="hidden">Footer content</h3>
<article class="column">
<h4>Contact Us</h4>
support@collectaccounting.com</article>
<article class="column midlist">
<h4>Quick Links</h4>
<ul>
<li><a href="javascript:void(0)">License Agreement</a></li>
<li><a href="http://collectaccounting.com/Login.php">Login</a></li>
<li><a href="javascript:void(0)">Download</a></li></ul></article>
<article class="column rightlist">
<h4>About Us</h4>
collectaccounting is cloud storage system. We focus on providing platform for record keeping.
<ul>
<li></li>
</ul></article></section>
<a href="#" class="go-top">Go Top</a>
</footer>


@endsection
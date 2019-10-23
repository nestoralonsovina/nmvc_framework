---


---

<center> <h1> NMVC Framework </h1> </center>
<center> <h2> Personal MVC Framework </h2> </center>
<p>This is a MVC (Model - View - Controller) coded in PHP for personal use.</p>
<h3 id="main-points-about-the-framework">Main points about the Framework</h3>
<p>Through the .htaccess files, we redirect all the requests through the root of the document, which is set to the /public directory.</p>
<p>The idea behind the framework is the following:</p>
<pre><code>The request -&gt; /pages/posts/edit/1
</code></pre>
<p>Will be redirected to /index.php where the Router is instantiate, that will process it as follows:</p>
<pre><code>Posts controller - Posts method - Argument 1 = 1 (id)
new Posts()-&gt;edit(1)
</code></pre>
<p>The controller will then deal with the view and process the $data array that will be passed into it.</p>
<p>There are no models included in the Framework, but should be created in a models folder inside the /app/</p>
<h3 id="example">Example</h3>
<p>If necessary, a basic example of the framework can be found in the <strong>example</strong> branch, just set a MAMP server to test it out.</p>
<p><em>Built following a tutorial, all the refactoring and documentation is entirely done by me.</em></p>


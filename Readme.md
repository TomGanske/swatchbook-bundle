#swatchBook-bundle#

SwatchBook is a color pallets management extension for the **Contao CMS in Version 4**. It`s full responsive and easy to implement into your website.

**Demo** 
> [Demo swatchBook](http://www.ct-eye.com/swatchbook.html)
 

> **Thanks!**

##Requirements##
* Contao Extension
* Version 2
* easy to use with Bootstrap

###Instruction to get it work###

1. open - vendor/composer/autoload_psr4.php and paste follow line inside the return array...
> 'CtEye\\swatchbookBundle\\' => array($baseDir."/src" . '/CtEye/swatchbook-bundle/src'),


2. open - app/AppKernel.php and paste follow line inside the $bundles = [...] block
> new CtEye\swatchbookBundle\swatchbookBundle(),


3. open the Install Tool and create the required tables for the swatchbook-bundle

4. activate inside the website layout the jQuery checkbox



*I think that`s it. Enjoy it and let me know...*




> *Tom Ganske*

> [Visit CT-EYE®](http://www.ct-eye.com)

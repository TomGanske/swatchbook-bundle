#swatchBook-bundle#

SwatchBook is a color pallets management extension for the **Contao CMS in Version 4**. It`s full responsive and easy to implement into your website.

**Demo** 
> [Demo swatchBook](http://www.ct-eye.com/swatchbook.html)
 

> **Thanks!**

##Requirements##
* Contao 4 CMS
* Bootstrap Framework

###Instruction to get it work###

1. create follow folder structure in your Contao 4 root directory
> src/CtEye/swatchbook-bundle/

2. copy the repository content starting with src inside the swatchbook-bundle folder
> before :: src/CtEye/swatchbook-bundle/
>
> after  :: src/CtEye/swatchbook-bundle/src/Resources/...

3. open - **vendor/composer/autoload_psr4.php** and paste follow line inside the return array...
> 'CtEye\\swatchbookBundle\\' => array($baseDir."/src" . '/CtEye/swatchbook-bundle/src'),


4. open - **app/AppKernel.php** and paste follow line inside the $bundles = [...] block
> new CtEye\swatchbookBundle\swatchbookBundle(),


5. create a symlink from your bundle folder
> open the path src/CtEye/swatchbook-bundle/src/Resources/
>
> create a Symlink from the **public** folder into the **web/** directory and rename it swatchbook
>
> finally you have a symlink folder under the **web/** directory called swatchbook

5. open the **Contao install tool** and create the required tables for the swatchbook-bundle

6. activate inside the website layout the jQuery checkbox



*I think that`s it. Enjoy it and let me know...*




> *Tom Hell*

> [Visit CT-EYE®](http://www.ct-eye.com)

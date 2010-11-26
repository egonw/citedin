	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>
			Citedin: A webtool to explore citations on the web
        </title>

        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <link type="text/css" href="development-bundle/themes/custom-theme/ui.all.css" rel="stylesheet">
        <script type="text/javascript" src="highslide/highslide-with-html.js"></script>
        <link rel="stylesheet" type="text/css" href="highslide/highslide.css" />
        <script type="text/javascript" src="development-bundle/ui/ui.core.js"></script>
        <script type="text/javascript" src="development-bundle/ui/ui.tabs.js"></script>
        <script type="text/javascript" src="js/jquery.tinysort.min.js"></script>
        <script type="text/javascript" src="js/jquery.corner.js"></script>


        <script type="text/javascript">
            $(document).ready(function(){
                $("#tabs").tabs();
            });

            var CitedIn = {};
            CitedIn.afterResourceLoad = function() {
                //Sort the results
                $("#resultaten>div").tsort("div.numberInSources", { order:"desc" });
                //Apply rounded corners
                $(this).corner();
            }
        </script>
        <script type="text/javascript" src="js/jquery.blockUI.js"></script>
        <link type="text/css" href="citedin.css" rel="stylesheet" />

        <script type="text/javascript">
            hs.graphicsDir = 'highslide/graphics/';
            hs.outlineType = 'rounded-white';
            hs.wrapperClassName = 'draggable-header';
        </script>

       <link rel="shortcut icon" type="image/png" href="favicon.ico">
    </head>
    <body>

        <?php include_once("analyticstracking.php");?>
        <div id="tabs">
            <ul>
                <li>
                    <a href="#fragment-1"><span>Citedin</span></a>
                </li>
                <li>
                    <a href="#fragment-2"><span>Resources</span></a>
                </li>
                <li>
                    <a href="#fragment-3"><span>Suggest resources</span></a>
                </li>

                <li>
                    <a href="#fragment-4"><span>Webservice</span></a>
                </li>
				<li>
					<a href="#fragment-5"><span>Resources using citedin</span></a>
                <li>
                    <a href="#fragment-6"><span>About citedin</span></a>
                </li>
            </ul>
            <div id="fragment-1">
                <?php include("fragment_1.php"); ?>

            </div>
            <div id="fragment-2">
                <?php 	include("included_resources.php"); ?>
            </div>
            <div id="fragment-3">
				If you know a resource that would enrich this website please send us an <a href="mailto:andra.waagmeester@bigcat.unimaas.nl">email</a><p>
 				Three types of resources are fit to be included in citedin.org, these are:
                <ul>
                    <li><b>Resources with webservices or an Application Programming Interface (API)</b>, which have functionality to search for pubmed identifiers. Examples with an API, are Wikipedia, Google Books, Google Blog and Connotea.</li>
                    <li><b>Complete databases dumps.</b> Most of the resources in citedin.org are obtained through parsing online available database dumps.</li>
                    <li><b>Supplementary data to published papers</b>. Some peer reviewed journal publication contain, next to the genereal references, appendices with (large) sets of pubmed identifiers. These citations, which are available as supplementary data are usually not considered as part of the papers bibliography. </li>
                </ul>
            </div>

            <div id="fragment-4">
                <?php include("api_citedin.html"); ?>
            </div>
				<div id="fragment-5">
	                <?php include("citedinUsers.php"); ?>
	            </div>
            <div id="fragment-6">
                <?php include("about_citedin.html"); ?>
            </div>

        </div>
        <script type="text/javascript">
            if (navigator.appCodeName != "Mozilla"){
                alert("Citedin is not optimized for your webbrowser, this may result in unexpected behaviour. For an optimized result, please use one of the following browsers: Google Chrome, Firefox, Opera, or Safari");
            }

        </script>
    </body>
</html>

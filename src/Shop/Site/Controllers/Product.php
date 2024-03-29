<?php
//TODO :: Try to explain what is going on at the line below.
/* Encapsulation: This allows us to create a controller Product as well as something like Shop\Models\Product.  */
namespace Shop\Site\Controllers;

class Product extends \Dsc\Controller
{   
    //TODO :: Try to explain what is going on at the line below.
    /* Importing a class from a different namespace */
	use \Dsc\Traits\Controllers\SupportPreview;

    protected function model($type=null)
    {   
        //TODO :: Try to explain what is going on at the line below.
        /* The variable $type, default is null, switch conditional where if $type is equal to products or product then the model equals Products else in any other situation $model equals Categories then return the model. */
        switch (strtolower($type))
        {
        	case "products":
        	case "product":
        	    $model = new \Shop\Models\Products;
        	    break;
        	default:
        	    $model = new \Shop\Models\Categories;
        	    break;
        }

        return $model;
    }
    

    public function packages() {
        $this->registerName(__METHOD__);


        //TODO :: Try to explain what is going on at the line below.
        /* Collecting the sanitized trackingnumber from the request. */
        $tracking = $this->inputfilter->clean( $this->app->get('PARAMS.trackingnumber'), 'string' );

        $model = new \Shop\Models\Products;
        $model->setCondition('tracking.model_number',strtoupper($tracking));
        $item = $model->getItem();

        if (empty($item->id)) {
            //TODO :: Try to explain what is going on at the line below.
            /* There was no model found for the tracking number that was collected from the request so return appropriate 4xx response with a message. */
    			$this->app->error( '404', 'Invalid Product' );
    	} else {
    	    $kits = $item->getKitsFromThisProduct();

            //TODO :: Try to explain what is going on at the line below. BONUS POINTS :: explain a few problems with this approach .
            /* Setting the html meta tag description as well as the title. One downside to this approach count($kits) could return 0, the title could be written "Packages Deals For {$item->title}" which is slightly faster than standard concatenation. */
    	    $this->app->set('meta.description', 'Save on these '. count($kits) . ' packages that include ' . $item->title. ' Save with Free Shipping & Expert Jeep Advice' );
    	    $this->app->set('meta.title', 'Packages Deals For '. $item->title);

            //TODO :: what do you think is happening here.
            /* The variables are being set so that the view has access to them. */
    	    $this->app->set('item', $item );
    	    $this->app->set('kits', $kits );

    	    $view = \Dsc\System::instance()->get('theme');
    	    echo $view->render('Shop/Site/Views::product/packages.php');
    	}

    }

}
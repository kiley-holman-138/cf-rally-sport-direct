<?php
namespace Shop\Site;
 //TODO :: what do you think is happening here.
 /* This is importing a Collection class */
use Dsc\Mongo\Collection;

class Routes extends \Dsc\Routes\Group
{

    public function initialize()
    {
        $f3 = \Base::instance();
         //TODO :: what do you think is happening here.
         /* Sets default params for all the routes including the default namespace for the Controllers. */
        $this->setDefaults( array(
            'namespace' => '\Shop\Site\Controllers',
            'url_prefix' => ''
        ) );
         //TODO :: what do you think is happening here.
         /* Adding the base GET route that Calls the index method in the \Shop\Site\Controllers\Home */
        $this->add( '/', 'GET', array(
            'controller' => 'Home',
            'action' => 'index'
        ) );

        $this->add( '/part/packages/@trackingnumber', 'GET', array(
            'controller' => 'Product',
            'action' => 'Packages'
        ) );

        /* LOTS OF ROUTES HAVE BEEN OMITTED */

         //TODO :: How do you think that this method differs from the above methods in this class?
         /* This is adding the accounts addresses as variable(s) to the GET request. */
        $this->addCrudItem('Address', array(
            'namespace' => '\Shop\Site\Controllers',
            'url_prefix' => '/account/addresses'
        ));

        $this->add( '/account/addresses', 'GET|POST', array(
            'controller' => 'Address',
            'action' => 'index'
        ) );

        /* BONUS CHALLENGE  */
        //create route for challenge
        $this->add('/challenge/accepted', 'GET', [
            'controller' => 'Challenge',//use Challenge Controller
            'action' => 'index'//call the index method.
        ])
        
    }
}

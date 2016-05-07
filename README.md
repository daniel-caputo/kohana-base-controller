This controller is base on the [jamierumbelow](hhttps://github.com/jamierumbelow/codeigniter-base-controller, "Title")'s controller

## Views and Layouts

Views will be loaded automatically based on the current controller and action name. Any variables set in `$this->data` will be passed through to the view and the layout. By default, the class will look for the view in _application/views/controller/action.php_.

In order to prevent the view being automatically rendered, set `$this->view` to `FALSE`.

    $this->view = FALSE;


##  Hierarchical Rendering¶
this controller  will find automatically for view files at this order.

    1. application/views/index.php
    2. application/views/layouts/[controller].php
    3. application/views/layouts/[directory].php
    4. application/views/layouts/[directory]/[controller].php
    5. application/views/[directory]/[controller]/[action].php

In order to specify where in your layout you'd like to output the view, the rendered view will be stored in a `$yield` variable:

For Example

    # /application/views/index.php
    <!DOCTYPE html>
    <html>
        <head>
            <title>title</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <div>
                <?= $yield ?>
            </div>
        </body>
    </html>

    

## Asides

Asides are a great way to insert variable content into your layouts that might need to change on an action by action basis. This is especially helpful when you want to load sidebars or render separate forms of navigation.

Asides are arbitrary views loaded into variables. They can be set using the `$this->asides` variable:

    protected $asides = array( 'sidebar' => 'users/_sidebar' );

They're then exposed as `$yield_` variables in the layout:

    <div id="sidebar">
        <?= $yield_sidebar ?>
    </div>

Any variables in `$this->data` will be passed through to the sidebar.
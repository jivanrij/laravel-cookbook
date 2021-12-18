# Laravel Cookbook

### Models and there relations used in the examples
![Models and there relations used in the examples](https://raw.githubusercontent.com/jivanrij/laravel-cookbook/main/models.png) 

### Eloquent examples

#### Improving speed & memory usage in Eloquent

[Eloquent - with - Limiting the amount of loaded fields](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Services/PostService.php#L20)      
[Eloquent - with - Limiting the amount of fields loaded in relations](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Services/PostService.php#L23)      
[Eloquent - toBase - Prevent Model loading, reducing memory usage](https://github.com/jivanrij/laravel-cookbook/blob/main/tests/EloquentTest.php#L13)  
[Eloquent - Speed up retrieving data from related models](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Http/Controllers/PostController.php#L10)

#### Neat query tricks
[Eloquent - Search with multiple terms over multiple models](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Models/User.php#L60)  
[Eloquent - whereHas - Only query if the relation exists with some condition](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Services/PostService.php#L30)
[Eloquent - addSelect - Add an attribute on a model based on a related models attribute](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Models/Post.php#L40)  

#### Date(time) 
[Eloquent - whereDate - Several data related where examples](https://github.com/jivanrij/laravel-cookbook/blob/main/tests/EloquentTest.php#L25)

#### Miscellaneous    
[Eloquent - increment - Incrementing values](https://github.com/jivanrij/laravel-cookbook/blob/main/tests/EloquentTest.php#L73)        
[Eloquent - replicate - Replicate a model](https://github.com/jivanrij/laravel-cookbook/blob/main/tests/EloquentTest.php#L86)  

#### Caching unique select queries

You can cache all select queries in a request, so no double queries get executed. To acomplisch this you can add the [```App\Traits\CacheQueryBuilderTrait```](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Traits/CacheQueryBuilderTrait.php) trait to your model. This will overrule the [```newBaseQueryBuilder```](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Traits/CacheQueryBuilderTrait.php#L14) of the model with it's own builder ([```App\Database\CacheQueryBuilder```](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Database/CacheQueryBuilder.php)).
Now all select queries get cached for one second within the scope of the request.

#### Detailed query log

[```App\Services\QueryMonitorService```](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Services/QueryMonitorService.php) provides logic to register and log a lot of performance related details about all the queries done to the database.    
[```App\Facades\QueryMonitorFacade```](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Facades/QueryMonitorFacade.php) is the Facade class of the [```App\Services\QueryMonitorService```](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Facades/QueryMonitorFacade.php). 


Add the following method to [```App\Http\Kernel```](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Http/Kernel.php):
```php
    public function terminate($request, $response)
    {
        // Write all the remembered queries to the info log before the request exits.
        \App\Facades\QueryMonitorFacade::logResults();
        parent::terminate($request, $response);
    }
```


Put the following in the [```App\Providers\AppServiceProvider::register()```](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Providers/AppServiceProvider.php#L17):
```php
// Registers the query listener
\App\Facades\QueryMonitorFacade::injectListener();
```

Put the following in the [```App\Providers\AppServiceProvider::boot()```](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Providers/AppServiceProvider.php#L27):
```php
// Start listening for queries
\App\Facades\QueryMonitorFacade::startListening();
```

## Laravel Nova

### Resource forms
[App\Nova\Actions\FlowAction](https://github.com/jivanrij/laravel-cookbook/blob/main/app/Nova/Actions/FlowAction.php) contains an example using the epartment/nova-dependency-container package to create some sort of flow in an Action form modal.

## Other resources

[Introduction to Package Development](https://laravelpackage.com/)    

### Packages

[Debug bar](https://github.com/barryvdh/laravel-debugbar) Adds a debug bar that provides you with debug information of the request.

[Shift Blueprint](https://github.com/laravel-shift/blueprint) Blueprint is an open-source tool for rapidly generating multiple Laravel components from a single, human-readable definition.

[Medialibrary](https://github.com/spatie/laravel-medialibrary) This package can associate all sorts of files with Eloquent models. It provides a simple API to work with.

[Permissions](https://github.com/spatie/laravel-permission) This package allows you to manage user permissions and roles in a database.

[Package skeleton](https://github.com/spatie/package-skeleton-laravel) A package skeleton Spatie uses for there packages.

[Translatable](https://github.com/spatie/laravel-translatable) This package contains a trait to make Eloquent models translatable. Translations are stored as json. There is no extra table needed to hold them.

[Excel](https://laravel-excel.com/) Supercharged Excel exports and imports in Laravel.

[Scribe](https://github.com/knuckleswtf/scribe) Generate API documentation for humans from your Laravel codebase.

[ER diagram generator](https://github.com/beyondcode/laravel-er-diagram-generator) This package lets you generate entity relation diagrams by inspecting the relationships defined in your model files.

[Nova - Settings](https://github.com/optimistdigital/nova-settings) This Laravel Nova package allows you to create custom settings in code (using Nova's native fields) and creates a UI for the users where the settings can be edited.

[Laravel Packer](https://github.com/bitfumes/laravel-packer) Laravel Packer is a command line tool for speeding up your package creation.

[Nova - Tiptap Editor Field](https://github.com/manogi/nova-tiptap) A WYSIWYG editor that's probably better then Trix.

[Nova - Collapsible Resource Manager](https://github.com/dcasia/collapsible-resource-manager)

[Nova - Resource Navigation Tab](https://novapackages.com/packages/digital-creative/resource-navigation-tab)

[Nova - translatable](https://github.com/spatie/nova-translatable) This package contains a Translatable class you can use to make any Nova field type translatable.

[Nova - tags field](https://github.com/spatie/nova-tags-field) This package contains a Nova field to add tags to resources.

[Nova - package skeleton](https://github.com/spatie/skeleton-nova-tool) This repo contains a skeleton to easily create Nova Tool packages.

### Fun facts

#### Creating migrations
When ending your migration name with to_[table], Laravel automatically adds the Schema call into the new migration file.

The command ```php artisan make:migration foo_bar_to_users``` will results in:
```php
Schema::table('users', function (Blueprint $table) {
    //
});
```


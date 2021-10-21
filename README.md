# Laravel samples

## Laravel

### Used example models
A ```User``` has one ```PersonalInfo``` pointing to it. ```PersonalInfo``` is a model with extra person data.   
```User``` hasOne > ----- < belongsTo ```PersonalInfo```   

A ```User``` has multiple ```Post``` pointing towards it.   
```User``` hasMany > ----- < belongsTo ```Post```   

A ```Post``` has multiple ```Comment``` pointing towards it.   
```Post``` hasMany > ----- < ```belongsTo```   

Multiple ```Post``` have multiple ```Categories```, they connect through the ```category_post``` table.    
```Post``` belongsToMany > ----- < belongsToMany ```Categories``` 

### Eloquent queries


### Caching unique select queries

You can cache all select queries in a request, so no double queries get executed. To acomplisch this you can add the ```App\Traits\CacheQueryBuilderTrait``` trait to your model. This will overrule the ```newBaseQueryBuilder``` of the model with it's own builder (```App\Database\CacheQueryBuilder```).
Now all select queries get cached for one second within the scope of the request.

### Detailed query log

```App\Services\QueryMonitorService``` provides logic to register and log a lot of performance related details about all the queries done to the database.
```App\Facades\QueryMonitorFacade``` is the Facade class of the ```App\Services\QueryMonitorService```. 

Add the following method to ```App\Http\Kernel```:
```php
    public function terminate($request, $response)
    {
        // Write all the remembered queries to the info log before the request exits.
        \App\Facades\QueryMonitorFacade::logResults();
        parenths
        ::terminate($request, $response);
    }
```

Put the following in the ```App\Providers\AppServiceProvider::register()```:
```php
// Registers the query listener
\App\Facades\QueryMonitorFacade::injectListener();
```

Put the following in the ```App\Providers\AppServiceProvider::boot()```:
```php
// Start listening for queries
\App\Facades\QueryMonitorFacade::startListening();
```

## Laravel Nova

### Resource forms
[App\Nova\Actions\FlowAction](#) contains an example using the epartment/nova-dependency-container package to create some sort of flow in an Action form modal.

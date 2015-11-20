# View

Set of tools for enhancing Laravel blade view management.

**Install** with composer :

    composer require white-frame/view:0.*

**Register** the service provider :

    WhiteFrame\View\ViewServiceProvider::class

## Nesting views into another views (hooking blade view sections)

The facade `WhiteFrame\View` allows you to nest blade view into another blade views. It can be usefull if you have a modular application witch need to dynamically add content into sections etc ...

### Simple example :

Here is your general `layout.blade.php`, with a `sidebar-menu` section. This section has two default links and need to be filled with other new menu links from dynamic modules :

```html
<!DOCTYPE html>
[ ... ]
<body>
<section class="sidebar">
	<ul class="sidebar-menu">
		@section("sidebar-menu")
		  <li><a href="{{ url('layout_page_1') }}">Layout page 1<</a></li>
		  <li><a href="{{ url('layout_page_2') }}">Layout page 2</a></li>
		@show
	</ul>
</section>
[...]
</body>
</html>
```

In a specific module, create a partial view to be included, for example `my_module::layout.menu` :

```html
@section("sidebar-menu")
	@parent
	
	<li><a href="{{ url('my_module/my_page') }}">My module page</a></li>
@stop
````

And then nest this partial view into the layout section using `WhiteFrame\View` into the service provider of your module :

```php
public function boot()
{
  \WhiteFrame\View::nest('layout', 'my_module::layout.menu');
  /*
   * You can use 3 params : nest view (host), nested view (child), array containing datas for nested view (optionnal)
   */
}
```

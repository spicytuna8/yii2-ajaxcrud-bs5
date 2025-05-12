yii2-ajaxcrud 
=============
Original work by johitvn.
Gii CRUD template for Single Page Ajax Administration for yii2 

![yii2 ajaxcrud extension screenshot]
![image](https://github.com/user-attachments/assets/84c06ab2-0ead-4d06-83eb-c369092c29fa)
![image](https://github.com/user-attachments/assets/143d5a20-865f-43f2-bda2-15ecf721da37)

Features
------------
+ Create, read, update, delete in onpage with Ajax
+ Bulk delete suport
+ Pjax widget suport
+ Export function(pdf,html,text,csv,excel,json)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require --prefer-dist spicytuna8/yii2-ajaxcrud-bs5 "*"
```

or add

```
"spicytuna8/yii2-ajaxcrud-bs5": "*"
```

to the require section of your `composer.json` file.


Usage
-----
For first you must enable Gii module Read more about [Gii code generation tool](http://www.yiiframework.com/doc-2.0/guide-tool-gii.html)

Because this extension used [kartik-v/yii2-grid](https://github.com/kartik-v/yii2-grid) extensions so we must config gridview module before

Let 's add into modules config in your main config file
````php
'modules' => [
    'gridview' =>  [
        'class' => '\kartik\grid\Module'
    ]       
]
````
Add translation to the config
````php
'components' => [
    'i18n' => [
        'translations' => [
            'yii2-ajaxcrud' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@yii2ajaxcrud/ajaxcrud/messages',
                'sourceLanguage' => 'en',
            ],
        ]
    ]
]
````
Add bsVersion to the params file
````php
return [
    'bsVersion' => '5.x',
];
````
You can then access Gii through the following URL:

http://localhost/path/to/index.php?r=gii

and you can see <b>Ajax CRUD Generator</b>



# MY_model 사용법

```php
{Model_Name} extend MY_model {

    ...

	function __construct()
	{
		parent::__construct();
		
		$this->TABLE_NAME = '{Table_Name}';
		$this->PK_NAME = '{PK_Name}';
    }

    ...

}
```
<?hh

call_user_func(fun('var_dump'), 1);

$v = Vector {
  Vector {1, 2, 3},
  Vector {1, 2}
};
var_dump($v->map(meth_caller('HH\Vector', 'count')));
var_dump(meth_caller('HH\Vector', 'count')->getClassName());
var_dump(meth_caller('HH\Vector', 'count')->getMethodName());

class C {
  public static function isOdd($i) { return $i % 2 == 1;}
  public function filter($data)  {
    $callback = inst_meth($this, 'isOdd');
    return $data->filter($callback);
  }

  public function id<T>(T $x): T {
    return $x;
  }
}
$data = Vector { 1, 2, 3 };
var_dump($data->filter(class_meth('C', 'isOdd')));
var_dump((new C)->filter($data));

$caller = meth_caller(C::class, 'id');
var_dump($caller(new C(), 'Hello World!'));
var_dump($caller(new C(), 1337));

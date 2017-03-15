# Upgrade

## 0.8.0 -> 1.0.0

### Removal of explicit `MethodNameInflector` dependency on `Projector` and `Processor` classes

We removed the explicit `MethodNameInflector` dependency on `Projector` and `Processor` instances, instead this will be injected when the class is being resolved from the IoC container

```diff
class BookProjector extends Projector
{
-		public function __construct(MethodNameInflector $inflector, ReadRepository $readRepository)
+		public function __construct(ReadRepository $readRepository)
		{
	-     parent::__construct($inflector);
				$this->readRepository = $readRepository;
		}
}

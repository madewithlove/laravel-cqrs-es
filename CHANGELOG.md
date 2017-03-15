### 1.0.1

### Fixed

- Fixed incorrect binding for EventManagement interface
- Fixed missing parameters when constructing a DbalEventStore

### 1.0.0

### Changed

- `MethodNameInflector` dependencies are now injected when resolving from the IoC.
- Upgraded to broadway 1.0.0

### Fixed

- `Processor` classes now correctly require you to prefix methods with `process` instead of `project`.
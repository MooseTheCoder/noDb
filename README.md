# noDb
----------
**Constants**
**NODBROOT**
*Path to data storage (outside of your web root)*
**NODBKEY**
*Password used to encrypt data*
 **NODBIV**
*IV used in data encryption*

**Functions**
**nodb_create_table();**
*Create a "table", accepts array*

    nodb_create_table(['table'=>'test'])

**nodb_add_entry();**
*Add en entry, accepts array*

    nodb_create_entry(['table'=>'test','name'=>'name','data'=>['username'=>'test']])

**nodb_get_entry();**
*Returns data from an entry*

    nodb_get_entry(['table'=>'test','name'=>'test']);

**nodb_remove_entry();**
*Removes an entry from a "table"*

    nodb_remove_entry(['table'=>'test','name'=>'test']);


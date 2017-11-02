# noDb
Basically...a database...without a database...

# Constants
### NODBROOT
Path to data storage (outside of your web root)
### NODBKEY
Password used to encrypt data
### NODBIV
IV used in data encryption

# Functions
### nodb_create_table();
Create a "table", accepts array
        nodb_create_table(['table'=>'test'])
### nodb_add_entry();
### nodb_get_entry();
### nodb_remove_entry();

# Resource Query Language
## introduction
  
Resource Query Languages (RQL) defines a syntactically simple query language for querying and retrieving resources. RQL is designed to be URI friendly, particularly as a query component of a URI, and highly extensible. RQL is a superset of HTML's URL encoding of form values, and a superset of Feed Item Query Language (FIQL).
   
## Conventions
  
The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED", "MAY", and "OPTIONAL" in this document are to be interpreted as described in RFC 2119.
  
## Overview
  
RQL consists of a set of nestable named operators which each have a set of arguments. RQL is designed to be applied to a collection of resources. Each top-level operator defines a constraint or modification to the result of the query from the base collection of resources. Nested operators provide constraint information for the operators within which they are embedded.
  
## Operators
  
An operator consists of an operator name followed by a list of comma-delimited arguments within paranthesis:
  
```sql
name(args,...)
```

Each argument may be a value (a string of unreserved or URL-encoded characters), an array, or another operator. The name of the operator indicates the type of action the operator will perform on the collection, using the given arguments. This document defines the semantics of a set of operators, but the query language can be extended with additional operators.

A simple RQL query with a single operator that indicates a search for any resources with a attribute of "foo" that has value of 3 could be written:

```sql
eq(foo,3)  
```
  
## Values
  
Simple values are simply URL-encoded sequences of characters. Unreserved characters do not need to be encoded, other characters should be encoding using standard URL encoding. Simple values can be decoded to determine the intended string of characters. Values can also include arrays or typed values. These are described in the "Typed Values" and "Arrays" section below.
  
## Arrays
  
One of the allowable arguments for operators is an array. An array is paranthesis-enclosed comma-delimited set of items. Each item in the array can be a value or an operator. A query that finds all the resources where the category can be "toy" or "food" could be written with an array argument:

```sql
in(category,(toy,food))
```
  
## Nested Operators
  
Operators may be nested. For example, a set of operators can be used as the arguments for the "or" operator. Another query that finds all the resources where the category can be "toy" or "food" could be written with nested "eq" operators within an "or" operator:
  
```sql
   or(eq(category,toy),eq(category,food))
```   
## Glossary

* attribute
  
The attributes used in ByteFerry RQL correspond to the attributes in the front-end JS.
Attribute refers to the name of the column in the data table, that is, the name of the field, and it is also the name of the attribute in the class in the object-oriented program.
Therefore, the attribute used in the document is the name of the field, which is the field name, which corresponds to the front-end table, which is the column name, and for the model, it is the property name.
  
* qualifier
  
ByteFerry RQL uses qualifier to represent the property in the query object, so as not to be confused with the current object-oriented and properties in the table.
That is to say, qualifier is a property in QueryObject   
  
##  Defined Operators
  
RQL defines the following semantics for these operators:  (Note: the opertors in the list is according the specification of byteferry rql)
  
### Query Operators  
    
#### all

all(<name-of-resource>,<qualifier>...) - Query the resource by name given and without pagination. This is a query for reading.

#### any

any(<name-of-resource>,<qualifier>...) - Query the resource by name given and with pagination. This is a query for reading.

#### count
 
count(<name-of-resource>,<qualifier>...) - Query the record count of resource by name given. This is a query for reading.
 
#### create
 
create(<name-of-resource>,<qualifier>...) - Query the resource by name given for adding a new record. This is a query for writing.

#### decrement

decrement(<name-of-resource>,<qualifier>...) - Query the resource by name given for decrement the column given. This is a query for writing.

#### delete

delete(<name-of-resource>,<qualifier>...) - Delete the record of the resource by filter. This is a query for writing.
 
#### exists

exists(<name-of-resource>,<qualifier>...) - Check if the record of the resource exists by filter. This is a query for reading.

#### first
 
first(<name-of-resource>,<qualifier>...) - Query the first record from resource by name given and with sort. This is a query for reading.

#### increment
 
increment(<name-of-resource>,<qualifier>...) -  Query the resource by name given for increment the column given. This is a query for writing.

#### one
  
onr(<name-of-resource>,<qualifier>...) - Query the a record from resource by the filter. This is a query for reading.

#### update
  
update(<name-of-resource>,<qualifier>...) - Update the record of the resource by filter. This is a query for writing.
 
### Column Operators

#### aggr
 
 aggr(<attribute> | <function>,...) - Alias of aggregate. please see aggregate.
 
#### aggregate
  
aggregate(<attribute|operator>,...) - The aggregate function can be used for aggregation, it aggregates the result set, grouping by objects that are distinct for the provided attributes, and then reduces the remaining other attribute values using the provided operator. To calculate the sum of sales for each department:
 ```sql
   aggregate(departmentId,sum(sales))
 ``` 
 #### average
   
 average(<attribute?>) - Finds the average of every value in the array or if the attribute argument is provided, returns the average of the value of attribute for every object in the array.
  
 #### avg
   
 avg(<attribute?>) - Alias of average. Please see average.
   
 #### cols
  
cols(<attribute>, ...) - Alias of columns.  Please see columns.
  
#### columns
 
columns(<attribute>) - Returns a query result where each item is value of the attribute specified by the argument
 
columns(<attribute>,<attribute>,...) - Trims each object down to the set of attributes defined in the arguments
 
#### distinct 
 
distinct(<attribute>, ...) - Returns a result set with duplicates removed.
 
#### except 
 
except(<attribute>, ...) - Give the names of the  attribute which is not need.
 
#### max 
 
max(<attribute?>) - Finds the maximum of every value in the array or if the attribute argument is provided, returns the maximum of the value of attribute for every object in the array

#### mean
  
 mean(<attribute?>) - Alias of average. Please see average.
  
#### max 
  
min(<attribute?>) - Finds the minimum of every value in the array or if the attribute argument is provided, returns the minimum of the value of attribute for every object in the array
  
#### only
  
only(<attribute>,...) -  Alias of columns. Please see columns. 
  
#### select
  
select(<attribute>,...) -  Alias of columns. Please see columns. 
  
#### sum 
  
sum(<attribute?>) - Finds the sum of every value in the array or if the attribute argument is provided, returns the sum of the value of attribute for every object in the array
   
#### values 
  
values(<attribute?>) - Finds the values of every value in the array or if the attribute argument is provided, returns the array(not the structure of key-value).
  
### Filter Operators

#### filter

filter(<condition>) - Filter the query with condition with is logic expression or predicate. 
  
#### having

having(<condition>) - Filter the aggrigate query with condition with is logic expression or predicate. 
  
## Logic Operators
 
#### and
  
and(<predicate>,<predicate>,...) - Returns a query result set applying all the given operators to constrain the predicate
  
#### not
  
and(<predicate>) - Returns a value of logic not with given predicate.

#### or
  
or(<predicate>,<predicate>,...) - Returns a union result set of the given operators
  
### Predicate Operators
  
#### between
  
between (<attribute>, <min-value>, <max-value>) - Returns the value of the attribute is between min-value and max-value.
  
#### eq
  
eq(<attribute>,<value>) - Filters for objects where the specified attribute's value is equal to the provided value.
  
#### ge
  
   ge(<attribute>,<value>) - Filters for objects where the specified attribute's value is greater than or equal to the provided value.
   
#### gt
   
   gt(<attribute>,<value>) - Filters for objects where the specified attribute's value is greater than the provided value.
  
#### in
 
in(<attribute>,<array-of-values>) - Filters for objects where the specified attribute's value is in the provided array.
 
#### le 
 
le(<attribute>,<value>) - Filters for objects where the specified attribute's value is less than or equal to the provided value.
   
#### like
   
like(<attribute>,<value>) - Filter property values which are like (similar) a value.

#### lt
  
  lt(<attribute>,<value>) - Filters for objects where the specified attribute's value is less than the provided value
   
#### ne
 
 ne(<attribute>,<value>) - Filters for objects where the specified attribute's value is not equal to the provided value
  
#### neq

 neq(<attribute>,<value>) - Alias of `ne`. please see `ne`.
 
 
#### nin  

nin(<attribute>,<array-of-values>) - Alias of `out`. please see `out`.
   
#### out  
  
out(<attribute>,<array-of-values>) - Filters for objects where the specified attribute's value is not in the provided array. 
  
### Constant Operators
 
#### true

true()  - Returns the value 1;

#### false

false()  - Returns the value 0;

#### null

null()  - Returns the null;

#### empty

empty()  - Returns the empty string "";

### Other Operators
 
#### data
 
data(< attribute:value >...) - It is used in the writing query for submit data.
 
#### limit
  
limit(<skip>, <max-count>) or limit(<page>,<per-page>) - It is useed for pagination.
 
#### search
 
search(<value>) - submit a value to the the searchable  attributes.
  
#### sort
  
sort(<+|-><attribute>) - Sorts the returned query result by the given attribute. The order of sort is specified by the prefix (+ for ascending, - for descending) to attribute. To sort by foo in ascending order:
```sql
  sort(+foo)
```
One can also do multiple attribute sorts. To sort by price in ascending order and rating in descending order:
```sql
   sort(+price,-rating)
```
  
## References
* [Resource Query Language draft-zyp-rql-00](https://dundalek.com/rql/draft-zyp-rql-00)
* [RQL Rules](http://www.persvr.org/rql/) 

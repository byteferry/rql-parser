# Resource Query Language
## 简介
  
资源查询语言（RQL）定义了一种语法简单的查询语言，用于查询和检索资源。 RQL被设计为URI友好的，尤其是作为URI的查询组件，并且具有高度可扩展性。 RQL是表单值的HTML URL编码的超集，也是Feed项目查询语言（FIQL）的超集。
   
## 约定
  
本文档中的关键字"MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED", "MAY",和"OPTIONAL"是 按照RFC 2119中的描述进行解释。
  
## 概述
  
RQL由一组可嵌套的命名操作符组成，每个操作符都有一组参数。 RQL旨在应用于资源集合。 每个顶级操作符都从资源的基本集合中定义对查询结果的约束或修改。 嵌套操作符为嵌入它们的操作符提供约束信息。 
  
## 操作符
  
一个操作符由一个操作符名称和一个括号内的逗号分隔参数列表组成：
  
```sql
name(args,...)
```

每个参数可以是一个值（一串未保留或URL编码的字符），一个数组或另一个操作符。 操作符的名称使用给定的参数指示操作符将对集合执行的操作的类型。 本文档定义了一组操作符的语义，但是查询语言可以使用其他操作符进行扩展。

可以编写一个带有单个操作符的简单RQL查询，该查询指示搜索属性值为“ foo”且值为3的任何资源：

```sql
eq(foo,3)  
```
  
## 数值
  
简单的数值只是URL编码的字符序列。 未保留的字符不需要进行编码，其他字符应使用标准URL编码进行编码。 可以对简单值进行解码以确定所需的字符串。 值还可以包括数组或键入的值。 这些在下面的“类型化值”和“数组”部分中进行了描述。
  
## 数组
  
操作符允许的参数之一是数组。 数组是用括号括住的逗号分隔的一组项目。 数组中的每个项目都可以是一个值或一个操作符。 可以使用数组参数编写一个查询，查找所有类别为“toy”（玩具）或“food”（食物）的资源。

```sql
in(category,(toy,food))
```
  
## 嵌套操作符
  
操作符可能是嵌套的。 例如，可以将一组操作符用作“或”操作符的参数。 可以在“或”操作符中使用嵌套的“ eq”操作符来编写另一个查询，该查询查找类别可以为“玩具”或“食品”的所有资源：
  
```sql
   or(eq(category,toy),eq(category,food))
```   
## 词汇表

* attribute
  
ByteFerry RQL 中使用attribute（特性）以使与前端JS技术相对应。 attribute是指数据表中的列的名字。这就是说，它也是我们平常说的字段名。同样，在面赂对象的程序语言的类中，我们称它为property。
所以，attribute在这里用作字段名，对应于前端的表格，即是其中的列名。而在后端的模型中，即是property的名字。
  
* qualifier
  
ByteFerry RQL 使用 qualifier（限定） 表示查询对像的属性。以使不会与现在面对象语言的 properties相混淆，同时也不与表中的properties混淆。 
 
这也就是说， qualifier是查询对象QueryObject的property。

* operator
  
本文档将operator翻译为操作符，因为，它的功能不只是计算，其实更像是function。
  
##  操作符定义
  
RQL为这些操作符定义了以下语义：（注意：列表中的操作符根据byteferry rql的规范）
  
### 查询操作符 
    
#### all

all(<name-of-resource>,<qualifier>...) - 通过给定的名称查询资源，而无需分页。 这是一个阅读查询。

#### any

any(<name-of-resource>,<qualifier>...) - 通过给定名称和分页查询资源。 这是一个阅读查询。

#### count
 
count(<name-of-resource>,<qualifier>...) -通过给定名称查询资源的记录数。 这是一个阅读查询。
 
#### create
 
create(<name-of-resource>,<qualifier>...) - 通过给定名称添加新记录。 这是一个写作查询。

#### decrement

decrement(<name-of-resource>,<qualifier>...) - 通过给定的名称查询资源使给定的列减一。 这是一个写作查询。
#### delete

delete(<name-of-resource>,<qualifier>...) - 通过过滤器删除资源记录。 这是一个写作查询。
 
#### exists

exists(<name-of-resource>,<qualifier>...) - 通过过滤器检查资源记录是否存在。 这是一个阅读查询。

#### first
 
first(<name-of-resource>,<qualifier>...) - 通过给定名称和排序方式从资源中查询第一条记录。 这是一个阅读查询。
 
#### increment
 
increment(<name-of-resource>,<qualifier>...) -  通过给定的名称查询资源使给定的列加一。 这是一个写作查询。
 
#### one
  
onr(<name-of-resource>,<qualifier>...) - 通过过滤器从资源中查询一条记录。 这是一个阅读查询。

#### update
  
update(<name-of-resource>,<qualifier>...) - 通过过滤器更新资源记录。 这是一个写作查询。
 
### 列操作符

#### aggr
 
 aggr(<attribute> | <function>,...)  aggregate的别名。请参见： aggregate。
 
#### aggregate
  
aggregate(<attribute|operator>,...) - 聚合操作符可用于聚合查询，它聚合结果集，按提供的对象的不同属性进行分组，然后使用提供的操作符组合其余的其他属性值。 比如：要计算每个部门的销售总额：
 ```sql
   aggregate(departmentId,sum(sales))
 ``` 
 #### average
   
 average(<attribute?>) - 查找数组中每个值的平均值，或者如果提供了属性参数，则返回数组中每个对象的属性值的平均值。
  
 #### avg
   
 avg(<attribute?>) - average的别名。请参见： average。
   
 #### cols
  
cols(<attribute>, ...) - columns的别名。请参见： columns。 
  
#### columns
 
columns(<attribute>) - 用参数指定要返回的列。
 
columns(<attribute>,<attribute>,...) -用参数指定要返回的是哪些列。
 
#### distinct 
 
distinct(<attribute>, ...) - 返回去重后的结果。
 
#### except 
 
except(<attribute>, ...) - 定义不需要返回的列。
 
#### max 
 
max(<attribute?>) - 查找数组中每个值的最大值，或者如果提供了属性参数，则返回数组中每个对象的属性值的最大值

#### mean
  
 mean(<attribute?>) - average的别名。请参见： average。
  
#### max 
  
min(<attribute?>) - 查找数组中每个值的最小值，或者如果提供了属性参数，则返回数组中每个对象的属性值的最小值
  
#### only
  
only(<attribute>,...) -  columns的别名。请参见： columns。 
  
#### select
  
select(<attribute>,...) -   columns的别名。请参见： columns。 
  
#### sum 
  
sum(<attribute?>) - 查找数组中每个值的总和，或者如果提供了属性参数，则返回数组中每个对象的属性值的总和。
   
#### values 
  
values(<attribute?>) - 查找数组中每个项的值，或者如果提供了属性参数，则返回数组（不是键值的结构）。
  
### 过滤操作符

#### filter

filter(<condition>) - 使用逻辑操作或谓词构成的查询条件过滤。（相当于SQL的WHERE）
  
#### having

having(<condition>) - 使用逻辑操作或谓词构成的查询条件对取合查询进行过滤。与SQL中的having对应。
  
## 逻辑操作符
 
#### and
  
and(<predicate>,<predicate>,...) - 返回一个查询结果集，该结果集应用所有给定的操作符来约束谓词。
  
#### not
  
and(<predicate>) - 返回不具有给定谓词的逻辑值。

#### or
  
or(<predicate>,<predicate>,...) - 返回给定操作符的并集结果集。
  
### 谓词操作符
  
#### between
  
between (<attribute>, <min-value>, <max-value>) - 返回属性的值在最小值和最大值之间。
  
#### eq
  
eq(<attribute>,<value>) - 筛选指定属性值等于提供值的对象。（与“=”对应）
  
#### ge
  
ge(<attribute>,<value>) - 筛选指定属性值大于或等于提供的值的对象（与“>=”对应）
   
#### gt
   
gt(<attribute>,<value>) - 筛选指定属性值大于提供的值的对象。（与“>”对应）
  
#### in
 
in(<attribute>,<array-of-values>) - 筛选指定属性值在提供的数组中的对象。
 
#### le 
 
le(<attribute>,<value>) - 筛选指定属性值小于或等于提供的值的对象。（与“<=” 对应）
   
#### like
   
like(<attribute>,<value>) - 过滤类似于（相似）值的属性值。
   
#### lt
  
lt(<attribute>,<value>) - 筛选指定属性值小于提供的值的对象。（与“<” 对应）
   
#### ne
 
 ne(<attribute>,<value>) -筛选指定属性值不等于提供值的对象。（与“<>” 对应）
  
#### neq

 neq(<attribute>,<value>) - ne 的别名。请参见ne。
 
 
#### nin  

nin(<attribute>,<array-of-values>) -  out 的别名。请参见out。  
   
#### out  
  
out(<attribute>,<array-of-values>) - 筛选指定属性值不在提供的数组中的对象。（相当于SQL的not in ）
  
### 常量操作符
 
#### true

true()  - 返回 1;

#### false

false()  - 返回 0;

#### null

null()  - 返回 null;

#### empty

empty()  - 返回 "";

### 其它操作符
 
#### data
 
data(< attribute:value >...) - 写查询中传递数据。
 
#### limit
  
limit(<skip>, <max-count>) 或者 limit(<page>,<per-page>) - 用于分页。
 
#### search
 
search(<value>) - 提交一个值给可搜索的字段。
  
#### sort
  
sort(<+|-><attribute>) - 按给定属性对返回的查询结果进行排序。 排序顺序由属性的前缀（+表示升序，-表示降序）指定。 要按foo升序排序：
```sql
  sort(+foo)
```
也可以进行多种属性排序。 按价格升序排序和评级降序排序：
 
```sql
   sort(+price,-rating)
```
  
## 参考资源
* [Resource Query Language draft-zyp-rql-00](https://dundalek.com/rql/draft-zyp-rql-00)
* [RQL Rules](http://www.persvr.org/rql/) 

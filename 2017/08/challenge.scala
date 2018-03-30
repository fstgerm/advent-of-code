import scala.io.Source

object Challenge {
  var registers: scala.collection.immutable.Map[String, Int] = Map()
  var highest: Int = Int.MinValue

  def main(args: Array[String]): Unit = {
    val source = Source.fromFile("input.txt")

    for (line <- source.getLines()) {
      val List(name, operation, number, a, condition, b) = line.split(" ").patch(3, Nil, 1).toList

      if (is_valid(get(a), b.toInt, condition)) {
        set(name, number.toInt, operation)
        highest = if (get(name) > highest) get(name) else highest
      }
    }

    source.close

    println(s"Part 1 : ${registers.valuesIterator.max}")
    println(s"Part 2 : ${highest}")
  }

  def get(name:String) : Int = {
    if (registers.contains(name)) registers(name) else return 0
  }

  def set(name:String, value:Int, operation:String) = {
    registers += name -> (if (operation == "inc") get(name) + value else get(name) - value)
  }

  def is_valid(a:Int, b:Int, condition:String) : Boolean = {
    return condition match {
      case "<"   => a < b
      case ">"   => a > b
      case "<="  => a <= b
      case ">="  => a >= b
      case "=="  => a == b
      case "!="  => a != b
    }
  }
}

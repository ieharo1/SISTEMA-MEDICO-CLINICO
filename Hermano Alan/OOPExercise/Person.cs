using System;

namespace OOPExercise
{
    public abstract class Person : IPerson
    {
        public string FirstName { get; set; }
        public string LastName { get; set; }
        public virtual void Greet()
        {
            Console.WriteLine("Hello, I'm a person!");
        }
    }
}

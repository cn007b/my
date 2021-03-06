import java.util.Arrays;
import java.util.Set;
import java.util.Set;
import java.util.HashSet;
import java.util.stream.Collectors;

public class set
{
    public static void main(String[] args)
    {
        // print();
        // inSet();
        // inHashSet();
        // loop();
        // len();
        fromIntSetToStrSet();
    }

    public static void fromIntSetToStrSet()
    {
        Set<Integer> si = getIntSet();
        Set<String> ss = si.stream().map(String::valueOf).collect(Collectors.toSet());
        System.out.println(si);
        System.out.println(ss);
    }

    public static Set<Integer> getIntSet()
    {
        Set<Integer> s = new HashSet<>();
        s.add(1);
        s.add(2);
        s.add(3);
        return s;
    }

    public static void len()
    {
        Set<String> s = getStrSet();
        System.out.println(s.size());
    }

    public static Set<String> getStrSet()
    {
        Set<String> hs = new HashSet<String>();
        hs.add("foo");
        hs.add("bar");
        return hs;
    }

    public static void inHashSet()
    {
        Set<Integer> s = new HashSet<>(Arrays.asList(1, 2, 3));
        System.out.println("\n[inHashSet]");
        System.out.println(s.contains(2));
    }

    public static void inSet()
    {
        Set<String> s = Set.of("foo", "boo");
        System.out.println("\n[inSet]");
        System.out.println(s.contains("boo"));
        System.out.println(s.contains("bar"));
    }

    public static void print()
    {
        Set<String> hs = getStrSet();
        System.out.println("\n[print]");
        System.out.print(hs);
    }

    public static void loop()
    {
        Set<String> hs = getStrSet();
        for(String s : hs){
           System.out.println(s);
        }
    }
}

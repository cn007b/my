import java.util.Date;

public class date
{
    public static void main(String[] args)
    {
        printTimestamp();
    }

    public static void printTimestamp()
    {
        Long timestamp = new Date().getTime() / 1000;
        System.out.println(timestamp);
    }
}

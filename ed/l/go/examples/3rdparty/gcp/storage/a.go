package storage

import (
	"context"
	"fmt"
	"log"

	"cloud.google.com/go/storage"
	"google.golang.org/api/iterator"
	"google.golang.org/api/option"
)

func Run(projectID, SAFilePath, bucketName string) {
	ctx := context.Background()
	c := getClient(ctx, SAFilePath)

	//printBuckets(ctx, c, projectID)
	uploadTestFile(ctx, c, bucketName)
}

func getClient(ctx context.Context, filepath string) *storage.Client {
	client, err := storage.NewClient(ctx, option.WithCredentialsFile(filepath))
	if err != nil {
		log.Fatal(err)
	}

	return client
}

func uploadTestFile(ctx context.Context, c *storage.Client, bucketName string) {
	b := c.Bucket(bucketName)

	wc := b.Object("test.txt").NewWriter(ctx)
	wc.ContentType = "text/plain"
	wc.Metadata = map[string]string{"x-test": "true"}

	if _, err := wc.Write([]byte("it works\n")); err != nil {
		log.Fatalf("unable to write data to bucket %v, error: %+v", bucketName, err)
	}

	if err := wc.Close(); err != nil {
		log.Fatalf("unable to close bucket %v file, error: %+v", bucketName, err)
	}
}

func printBuckets(ctx context.Context, c *storage.Client, projectID string) {
	it := c.Buckets(ctx, projectID)
	fmt.Println("Buckets:")
	for {
		attrs, err := it.Next()
		if err == iterator.Done {
			break
		}
		if err != nil {
			log.Fatal(err)
		}

		fmt.Println(attrs.Name)
	}
}

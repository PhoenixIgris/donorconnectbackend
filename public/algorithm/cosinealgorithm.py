import sys  
import json  
import numpy as np 
from sklearn.feature_extraction.text import TfidfVectorizer 
from sklearn.metrics.pairwise import cosine_similarity 

# Function to recommend posts
def recommend_posts(posts,  postContent):

    # Load JSON data representing posts and query post content
    posts_given  = json.loads(posts)  # Convert JSON string to Python dictionary
    query_post_content = json.loads(postContent)  # Convert JSON string to Python dictionary
    posts_given['query_post'] = query_post_content  # Add the query post to the posts_given dictionary

    # Combine all posts into a list
    all_posts = list(posts_given.values())

    # Initialize a TfidfVectorizer
    tfidf_vectorizer = TfidfVectorizer()

    # Transform the list of posts into a TF-IDF matrix
    tfidf_matrix = tfidf_vectorizer.fit_transform(all_posts)

    # Calculate cosine similarity between the query post and all other posts
    cosine_similarities = cosine_similarity(tfidf_matrix[-1], tfidf_matrix[:-1])

    # Get the indices of recommended posts sorted by cosine similarity score
    recommended_post_indices = cosine_similarities.argsort()[0][::-1]

    # Initialize an empty list to store recommended posts
    mylist = []

    # Iterate through the indices of recommended posts (limited to the first 5)
    for index in recommended_post_indices[:5]:
        # Retrieve the similarity score for the current recommended post
        similarity_score = cosine_similarities[0][index]
        try:
            # Create a dictionary representing the recommended post
            data = {
                "id": "{}".format(index + 1),
                "tags" : posts_given[str(index + 1)],
                "score": similarity_score
            }
            # Append the recommended post data to the list
            mylist.append(data)
        except KeyError:
            # Handle KeyError if the post ID is not found in the posts_given dictionary
           continue

    # Construct the response containing recommended posts, original posts, and query post content
    response = {
        "data": mylist,
        "posts_given": posts_given,
        "query_post_content": query_post_content
    }
    return response

# Entry point of the script
if __name__ == "__main__":
    # Get the query post content and all posts from command line arguments
    postContent = sys.argv[1]
    posts = sys.argv[2]

    # Call the recommend_posts function to generate recommendations
    recommended_posts = recommend_posts(posts, postContent)

    # Output the recommended posts as JSON
    print(json.dumps(recommended_posts))

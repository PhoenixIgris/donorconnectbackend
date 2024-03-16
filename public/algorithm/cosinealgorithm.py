
import sys
import json
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# Function to recommend posts


def recommend_posts(posts,  postContent):

# Vectorize posts and user profile separately for title and description
    posts_given  = json.loads(posts)
    query_post_content = json.loads(postContent)
    # Add the query post to the posts_given dictionary
    posts_given['query_post'] = query_post_content

# Tokenize the text of all posts
    all_posts = list(posts_given.values())

    tfidf_vectorizer = TfidfVectorizer()
    tfidf_matrix = tfidf_vectorizer.fit_transform(all_posts)

# Calculate cosine similarity between the query post and all other posts
    cosine_similarities = cosine_similarity(tfidf_matrix[-1], tfidf_matrix[:-1])

# Get the indices of recommended posts sorted by cosine similarity score
    recommended_post_indices = cosine_similarities.argsort()[0][::-1]

# Print recommended posts
    mylist =[]
    for index in recommended_post_indices[:5]:
        similarity_score = cosine_similarities[0][index]
        try:
            data ={
                "id": "{}".format(index + 1),
                "tags" : posts_given[str(index + 1)],
                "score": similarity_score
            }
            mylist.append(data)
        except KeyError:
           continue
    response = {
        "data": mylist,
        "posts_given": posts_given,
        "query_post_content": query_post_content
    }
    return response


if __name__ == "__main__":
    # # Get user profile and posts from command line arguments
    postContent = sys.argv[1]
    posts = sys.argv[2]
    # print(postContent)
    # Call function to recommend posts
    recommended_posts = recommend_posts(posts, postContent)

    # Output recommended posts as JSON
    print(json.dumps(recommended_posts))
    # print(posts)

